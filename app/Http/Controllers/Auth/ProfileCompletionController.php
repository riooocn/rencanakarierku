<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class ProfileCompletionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($request->filled('new_school')) {
            $institution = Institution::firstOrCreate(['name' => $request->new_school]);
        } else {
            $request->validate(['school_id' => 'required|exists:institutions,id']);
            $institution = Institution::find($request->school_id);
        }

        $user = $request->user();

        if ($user->role === 'admin') {
            $adminCount = User::where('institution_id', $institution->id)
                              ->where('role', 'admin')
                              ->where('id', '!=', $user->id)
                              ->count();
            if ($adminCount >= 3) {
                return back()->withErrors(['school_id' => 'Instansi ini sudah mencapai batas maksimal 3 admin.'])->withInput();
            }
        }
        
        $user->institution_id = $institution->id;
        $user->phone = $request->phone;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin;
        
        if ($user->role === 'peserta') {
            $request->validate(['grade' => 'required|string|max:50']);
            $user->grade = $request->grade;
        }

        $user->save();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/perjalananku');
    }
}
