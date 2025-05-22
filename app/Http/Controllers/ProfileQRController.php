<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileQRController extends Controller
{
        public function show($id)
    {
        // Hardcoded data for demo (you can replace this with DB data)
        $profiles = [
            'ripon' => [
                'name' => 'Md. Mahbubul Alam Ripon',
                'father' => 'Shorif Alam',
                'mother' => 'Mafruza Akter',
                'village' => 'Srirampur',
                'upazila' => 'Dhamrai, Dhaka',
                'dob' => '03/06/1985',
                'blood' => 'A+',
                'nid' => '19855624606132192',
                'tin' => '116838253890',
                'mobile' => '01711346953, 019111728974',
                'email' => 'ripon.dae13@gmail.com',
                'designation' => 'উপ-সহকারী কৃষি কর্মকর্তা'
            ]
        ];

        $profile = $profiles[$id] ?? null;

        if (!$profile) abort(404);

        return view('profile.show', compact('profile'));
    }
}
