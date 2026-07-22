<?php

namespace App\Exports;

use App\Models\KeputusanKarier;
use App\Models\Question;
use App\Models\AssessmentSession;
use App\Models\UserAnswer;
use App\Models\EksplorasiKarier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PesertaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $institutionId;
    protected $questions;
    protected $rowNumber = 0;

    public function __construct($institutionId = null)
    {
        $this->institutionId = $institutionId;
        // Fetch all questions to form headers
        $this->questions = Question::orderBy('id')->get();
    }

    public function collection()
    {
        $query = KeputusanKarier::with(['user.institution'])->orderBy('created_at', 'desc');
        
        if ($this->institutionId) {
            $query->whereHas('user', function ($q) {
                $q->where('institution_id', $this->institutionId);
            });
        }
        
        return $query->get();
    }

    public function headings(): array
    {
        $headers = [
            'No',
            'Waktu Pengisian',
            'Nama',
            'Email',
            'Instansi',
            'Jenis Kelamin',
            'Tanggal Lahir',
        ];

        $typesCount = [];
        foreach ($this->questions as $index => $q) {
            $type = $q->asesmen_type;
            if (!isset($typesCount[$type])) {
                $typesCount[$type] = 0;
            }
            $typesCount[$type]++;
            $num = $typesCount[$type];
            $prefix = match($type) {
                'minat' => 'Minat',
                'kapasitas_1' => 'Kapasitas Keterampilan',
                'kapasitas_2' => 'Kapasitas Mapel',
                'nilai_karier' => 'Nilai Karier',
                default => 'Q'
            };
            $headers[] = $prefix . " Q{$num}";
        }
        
        $eksplorasiFields = [
            'Pekerjaan', 'Pendidikan', 'Jurusan', 'Matkul', 'Keterampilan', 
            'Pelatihan', 'Sertifikasi', 'Peluang', 'Tugas', 'Info Lain'
        ];

        foreach ($eksplorasiFields as $label) {
            $headers[] = 'Eksplorasi 1 - ' . $label;
        }
        foreach ($eksplorasiFields as $label) {
            $headers[] = 'Eksplorasi 2 - ' . $label;
        }
        
        $headers[] = 'Keputusan Final';

        return $headers;
    }

    public function map($keputusan): array
    {
        $this->rowNumber++;

        $user = $keputusan->user;
        $timestamp = $keputusan->created_at;

        // Get the latest sessions for this user before or equal to this keputusan's timestamp
        $types = ['minat', 'kapasitas_1', 'kapasitas_2', 'nilai_karier'];
        $sessionIds = [];
        
        foreach ($types as $type) {
            $session = AssessmentSession::where('user_id', $user->id)
                ->where('asesmen_type', $type)
                ->where('status', 'completed')
                ->where('completed_at', '<=', $timestamp)
                ->orderBy('completed_at', 'desc')
                ->first();
            
            if ($session) {
                $sessionIds[] = $session->id;
            }
        }

        // Fetch all answers for these sessions
        $answers = collect();
        if (count($sessionIds) > 0) {
            $answers = UserAnswer::whereIn('session_id', $sessionIds)->get()->keyBy('question_id');
        }

        $row = [
            $this->rowNumber,
            $timestamp ? $timestamp->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') : '-',
            $user->name,
            $user->email,
            $user->institution ? $user->institution->name : '-',
            $user->jenis_kelamin ?? '-',
            $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '-',
        ];

        // Map answers
        foreach ($this->questions as $q) {
            $type = $q->asesmen_type;
            $answer = $answers->get($q->id);
            
            if ($type === 'minat' || $type === 'kapasitas_1') {
                // If exists, 1, else 0
                $row[] = $answer ? "1" : "0";
            } else {
                // Kapasitas 2 or Nilai Karier
                $row[] = $answer ? (string)$answer->answer_score : "0";
            }
        }
        
        // Fetch Eksplorasi Karier
        $eksplorasi = EksplorasiKarier::where('user_id', $user->id)
            ->where(function($q) use ($timestamp) {
                $q->whereNull('created_at')
                  ->orWhere('created_at', '<=', $timestamp);
            })
            ->orderBy('id', 'desc')
            ->take(2)
            ->get();
            
        $eksp1 = $eksplorasi->where('option', 1)->first();
        $eksp2 = $eksplorasi->where('option', 2)->first();
        
        if (!$eksp1 && !$eksp2 && $eksplorasi->count() > 0) {
             $eksp1 = $eksplorasi->get(0);
             $eksp2 = $eksplorasi->count() > 1 ? $eksplorasi->get(1) : null;
        }

        $ekspFieldsKeys = [
            'career_name', 'pendidikan', 'jurusan', 'matkul', 'keterampilan', 
            'pelatihan', 'sertifikasi', 'peluang', 'tugas', 'info_lain'
        ];
        
        foreach ($ekspFieldsKeys as $field) {
            $row[] = $eksp1 ? ($eksp1->$field ?? '-') : '-';
        }
        foreach ($ekspFieldsKeys as $field) {
            $row[] = $eksp2 ? ($eksp2->$field ?? '-') : '-';
        }
        
        // Keputusan
        $row[] = $keputusan->final_choice ?? '-';

        return $row;
    }
}
