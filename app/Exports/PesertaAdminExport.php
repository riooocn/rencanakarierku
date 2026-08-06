<?php

namespace App\Exports;

use App\Models\KeputusanKarier;
use App\Models\AssessmentSession;
use App\Models\UserAnswer;
use App\Models\EksplorasiKarier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PesertaAdminExport implements FromCollection, WithHeadings, WithMapping
{
    protected $institutionId;
    protected $rowNumber = 0;

    public function __construct($institutionId = null)
    {
        $this->institutionId = $institutionId;
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
        return [
            'No',
            'Waktu Pengisian',
            'Nama Siswa',
            'Email',
            'Instansi',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Minat 1', 'Minat 2', 'Minat 3',
            'Kapasitas 1', 'Kapasitas 2',
            'Mapel 1', 'Mapel 2', 'Mapel 3', 'Mapel 4', 'Mapel 5',
            'Nilai Karier 1', 'Nilai Karier 2', 'Nilai Karier 3',
            'Eksplorasi 1 - Profesi', 'Eksplorasi 1 - Pendidikan Minimal', 'Eksplorasi 1 - Jurusan Sesuai', 'Eksplorasi 1 - Mata Kuliah', 'Eksplorasi 1 - Keterampilan', 'Eksplorasi 1 - Pelatihan', 'Eksplorasi 1 - Sertifikasi', 'Eksplorasi 1 - Peluang',
            'Eksplorasi 2 - Profesi', 'Eksplorasi 2 - Pendidikan Minimal', 'Eksplorasi 2 - Jurusan Sesuai', 'Eksplorasi 2 - Mata Kuliah', 'Eksplorasi 2 - Keterampilan', 'Eksplorasi 2 - Pelatihan', 'Eksplorasi 2 - Sertifikasi', 'Eksplorasi 2 - Peluang',
            'Profesi Pilihan Akhir'
        ];
    }

    public function map($keputusan): array
    {
        $this->rowNumber++;

        $user = $keputusan->user;
        $timestamp = $keputusan->created_at;

        // Get the latest sessions for this user before or equal to this keputusan's timestamp
        $types = ['minat', 'kapasitas', 'nilai_karier'];
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

        // Fetch answers with question relation
        $answers = collect();
        if (count($sessionIds) > 0) {
            $answers = UserAnswer::with('question')
                ->whereIn('session_id', $sessionIds)
                ->get();
        }

        // --- Processing Minat ---
        $minatAnswers = $answers->filter(fn($a) => $a->question && $a->question->asesmen_type === 'minat');
        $minatMap = [
            1 => 'Realistic', 2 => 'Investigative', 3 => 'Artistic', 
            4 => 'Social', 5 => 'Enterprising', 6 => 'Conventional'
        ];
        
        $minatScores = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];
        foreach ($minatAnswers as $a) {
            $code = (int)$a->question->code;
            if (isset($minatScores[$code])) {
                $minatScores[$code]++;
            }
        }
        
        $top3Minat = collect($minatScores)->sortDesc()->take(3)->keys()
            ->map(fn($code) => $minatMap[$code] ?? '-')
            ->values()
            ->toArray();
            
        $minatRow = [
            $top3Minat[0] ?? '-', $top3Minat[1] ?? '-', $top3Minat[2] ?? '-'
        ];

        // --- Processing Kapasitas 1 (Keterampilan) ---
        $kapasitas1Answers = $answers->filter(fn($a) => $a->question && $a->question->asesmen_type === 'kapasitas_1');
        $kapasitas1Map = [
            1 => 'People', 2 => 'Data', 3 => 'Things', 4 => 'Ideas'
        ];
        
        $kapasitasScores = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
        foreach ($kapasitas1Answers as $a) {
            $code = (int)$a->question->code;
            if (isset($kapasitasScores[$code])) {
                $kapasitasScores[$code]++;
            }
        }
        
        $top2Kapasitas = collect($kapasitasScores)->sortDesc()->take(2)->keys()
            ->map(fn($code) => $kapasitas1Map[$code] ?? '-')
            ->values()
            ->toArray();
            
        $kapasitasRow = [
            $top2Kapasitas[0] ?? '-', $top2Kapasitas[1] ?? '-'
        ];

        // --- Processing Kapasitas 2 (Mapel) ---
        $kapasitas2Answers = $answers->filter(fn($a) => $a->question && $a->question->asesmen_type === 'kapasitas_2');
        $top5Mapel = $kapasitas2Answers
            ->sortByDesc('answer_score')
            ->take(5)
            ->map(fn($a) => $a->question->code) // code is the mapel name
            ->values()
            ->toArray();
            
        $mapelRow = [
            $top5Mapel[0] ?? '-', $top5Mapel[1] ?? '-', $top5Mapel[2] ?? '-', $top5Mapel[3] ?? '-', $top5Mapel[4] ?? '-'
        ];

        // --- Processing Nilai Karier ---
        $nilaiKarierAnswers = $answers->filter(fn($a) => $a->question && $a->question->asesmen_type === 'nilai_karier');
        $nilaiKarierMap = [
            1 => 'Leisure', 2 => 'Extrinsic Rewards', 3 => 'Intrinsic Rewards', 
            4 => 'Altruistic Rewards', 5 => 'Social Rewards'
        ];
        
        $nilaiKarierScores = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $nilaiKarierCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        
        foreach ($nilaiKarierAnswers as $a) {
            $code = (int)$a->question->code;
            if (isset($nilaiKarierScores[$code])) {
                $nilaiKarierScores[$code] += $a->answer_score;
                $nilaiKarierCounts[$code]++;
            }
        }
        
        $nilaiKarierAvgs = collect($nilaiKarierScores)->map(function($score, $code) use ($nilaiKarierCounts) {
            return $nilaiKarierCounts[$code] > 0 ? $score / $nilaiKarierCounts[$code] : 0;
        });
        
        $top3Nilai = $nilaiKarierAvgs->sortDesc()->take(3)->keys()
            ->map(fn($code) => $nilaiKarierMap[$code] ?? '-')
            ->values()
            ->toArray();
            
        $nilaiKarierRow = [
            $top3Nilai[0] ?? '-', $top3Nilai[1] ?? '-', $top3Nilai[2] ?? '-'
        ];
        
        // --- Fetch Eksplorasi Karier ---
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
            'pelatihan', 'sertifikasi', 'peluang'
        ];
        
        $eksp1Row = [];
        foreach ($ekspFieldsKeys as $field) {
            $eksp1Row[] = $eksp1 ? ($eksp1->$field ?? '-') : '-';
        }
        $eksp2Row = [];
        foreach ($ekspFieldsKeys as $field) {
            $eksp2Row[] = $eksp2 ? ($eksp2->$field ?? '-') : '-';
        }

        return array_merge(
            [
                $this->rowNumber,
                $timestamp ? $timestamp->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') : '-',
                $user->name,
                $user->email,
                $user->institution ? $user->institution->name : '-',
                $user->jenis_kelamin ?? '-',
                $user->tanggal_lahir ? Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '-',
            ],
            $minatRow,
            $kapasitasRow,
            $mapelRow,
            $nilaiKarierRow,
            $eksp1Row,
            $eksp2Row,
            [$keputusan->final_choice ?? '-']
        );
    }
}
