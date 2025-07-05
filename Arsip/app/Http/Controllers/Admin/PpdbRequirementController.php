<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbRequirement;

class PpdbRequirementController extends Controller
{
    public function edit()
    {
        $requirement = PpdbRequirement::first();
        return view('admin.ppdb.requirement_edit', compact('requirement'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $requirement = PpdbRequirement::first();
        if (!$requirement) {
            $requirement = new PpdbRequirement();
        }

        $requirement->content = $request->input('content');
        $requirement->save();

        return redirect()->back()->with('success', 'Syarat pendaftaran berhasil diperbarui!');
    }
}

