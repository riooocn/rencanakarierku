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
        ]);

        if ($request->filled('new_school')) {
            $institution = Institution::firstOrCreate(['name' => $request->new_school]);
        } else {
            $request->validate(['school_id' => 'required|exists:institutions,id']);
            $institution = Institution::find($request->school_id);
        }

        $user = $request->user();
        
        $user->institution_id = $institution->id;
        $user->phone = $request->phone;
        
        if ($user->role === 'peserta') {
            $request->validate(['grade' => 'required|string|max:10']);
            $user->grade = $request->grade;
        }

        $user->save();

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/perjalananku');
    }
}
