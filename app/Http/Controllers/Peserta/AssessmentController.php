<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\AsesmenResult;
use App\Models\AssessmentSession;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    // MINAT
    public function minat()
    {
        return view('peserta.asesmen.minat');
    }

    public function storeMinat(Request $request)
    {
        $request->validate([
            'minat' => 'required|array',
        ]);

        $user = $request->user();
        
        DB::transaction(function () use ($user, $request) {
            $session = AssessmentSession::create([
                'user_id' => $user->id,
                'asesmen_type' => 'minat',
                'status' => 'completed',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            $minatQuestions = Question::where('asesmen_type', 'minat')->orderBy('id')->get();
            $answers = [];
            $scores = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];

            foreach ($request->minat as $index) {
                $q = $minatQuestions[$index - 1] ?? null;
                if ($q) {
                    $answers[] = [
                        'session_id' => $session->id,
                        'question_id' => $q->id,
                        'answer_score' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    if (isset($scores[$q->code])) {
                        $scores[$q->code]++;
                    }
                }
            }
            UserAnswer::insert($answers);

            // Get top 3
            arsort($scores);
            $topResults = array_slice(array_keys($scores), 0, 3);

            AsesmenResult::create([
                'session_id' => $session->id,
                'recap_scores' => $scores,
                'top_results' => $topResults,
            ]);
        });

        return redirect()->route('asesmen.minat.hasil')->with('success', 'Asesmen Minat berhasil disimpan.');
    }

    public function minatHasil(Request $request)
    {
        $user = $request->user();
        $session = AssessmentSession::where('user_id', $user->id)
            ->where('asesmen_type', 'minat')
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$session) {
            return redirect()->route('asesmen.minat');
        }

        $result = AsesmenResult::where('session_id', $session->id)->first();

        return view('peserta.asesmen.minat-hasil', compact('result'));
    }


    // KAPASITAS
    public function kapasitas()
    {
        return view('peserta.asesmen.kapasitas');
    }

    public function storeKapasitas(Request $request)
    {
        $request->validate([
            'keterampilan' => 'required|array',
            'mapel' => 'required|array',
        ]);

        $user = $request->user();

        DB::transaction(function () use ($user, $request) {
            $session = AssessmentSession::create([
                'user_id' => $user->id,
                'asesmen_type' => 'kapasitas',
                'status' => 'completed',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            $answers = [];
            
            $ketQuestions = Question::where('asesmen_type', 'kapasitas_1')->orderBy('id')->get();
            $ketScores = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
            
            // Part 1: Keterampilan (checkboxes)
            foreach ($request->keterampilan as $index) {
                $q = $ketQuestions[$index - 1] ?? null;
                if ($q) {
                    $answers[] = [
                        'session_id' => $session->id,
                        'question_id' => $q->id,
                        'answer_score' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    if (isset($ketScores[$q->code])) {
                        $ketScores[$q->code]++;
                    }
                }
            }

            $mapelQuestions = Question::where('asesmen_type', 'kapasitas_2')->orderBy('id')->get();
            $mapelScores = [];
            
            // Part 2: Mapel (radio buttons)
            foreach ($request->mapel as $index => $score) {
                $q = $mapelQuestions[$index - 1] ?? null;
                if ($q) {
                    $answers[] = [
                        'session_id' => $session->id,
                        'question_id' => $q->id,
                        'answer_score' => $score,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $mapelScores[$q->code] = $score;
                }
            }
            UserAnswer::insert($answers);

            // Calculate Keterampilan (Top 2)
            arsort($ketScores);
            $topKet = array_slice(array_keys($ketScores), 0, 2);

            // Calculate Mapel (Top 5)
            arsort($mapelScores);
            $topMapel = array_slice(array_keys($mapelScores), 0, 5);

            AsesmenResult::create([
                'session_id' => $session->id,
                'recap_scores' => ['keterampilan' => $ketScores, 'mapel' => $mapelScores],
                'top_results' => ['keterampilan' => $topKet, 'mapel' => $topMapel],
            ]);
        });

        return redirect()->route('asesmen.kapasitas.hasil')->with('success', 'Asesmen Kapasitas berhasil disimpan.');
    }

    public function kapasitasHasil(Request $request)
    {
        $user = $request->user();
        $session = AssessmentSession::where('user_id', $user->id)
            ->where('asesmen_type', 'kapasitas')
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$session) {
            return redirect()->route('asesmen.kapasitas');
        }

        $result = AsesmenResult::where('session_id', $session->id)->first();

        return view('peserta.asesmen.kapasitas-hasil', compact('result'));
    }


    // NILAI KARIER
    public function nilaiKarier()
    {
        return view('peserta.asesmen.nilaikarier');
    }

    public function storeNilaiKarier(Request $request)
    {
        $request->validate([
            'nilaikarier' => 'required|array',
        ]);

        $user = $request->user();

        DB::transaction(function () use ($user, $request) {
            $session = AssessmentSession::create([
                'user_id' => $user->id,
                'asesmen_type' => 'nilai_karier',
                'status' => 'completed',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            $nkQuestions = Question::where('asesmen_type', 'nilai_karier')->orderBy('id')->get();
            
            $answers = [];
            $scoresByCode = [1 => [], 2 => [], 3 => [], 4 => [], 5 => []];
            
            foreach ($request->nilaikarier as $index => $score) {
                $q = $nkQuestions[$index - 1] ?? null;
                if ($q) {
                    $answers[] = [
                        'session_id' => $session->id,
                        'question_id' => $q->id,
                        'answer_score' => $score,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    if (isset($scoresByCode[$q->code])) {
                        $scoresByCode[$q->code][] = $score;
                    }
                }
            }
            UserAnswer::insert($answers);

            // Calculate averages
            $avgScores = [];
            foreach ($scoresByCode as $code => $scoresArray) {
                $avgScores[$code] = count($scoresArray) > 0 ? array_sum($scoresArray) / count($scoresArray) : 0;
            }
            
            arsort($avgScores);
            $topResults = array_slice(array_keys($avgScores), 0, 3);

            AsesmenResult::create([
                'session_id' => $session->id,
                'recap_scores' => $avgScores,
                'top_results' => $topResults,
            ]);
        });

        return redirect()->route('asesmen.nilaikarier.hasil')->with('success', 'Asesmen Nilai Karier berhasil disimpan.');
    }

    public function nilaiKarierHasil(Request $request)
    {
        $user = $request->user();
        $session = AssessmentSession::where('user_id', $user->id)
            ->where('asesmen_type', 'nilai_karier')
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$session) {
            return redirect()->route('asesmen.nilaikarier');
        }

        $result = AsesmenResult::where('session_id', $session->id)->first();

        return view('peserta.asesmen.nilaikarier-hasil', compact('result'));
    }
}
