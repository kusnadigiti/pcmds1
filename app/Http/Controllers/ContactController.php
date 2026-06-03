<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();

        return view('pages.admin.contact.index', compact('contact'));
    }

    public function edit()
    {
        $contact = Contact::first();

        return view('pages.admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = Contact::first();

        $validated = $request->validate([
            'address' => 'required|string|max:500',
            'phone' => 'required|string|min:10|max:20',
            'email' => 'required|string|email|max:100',
            'operational_days_start' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'operational_days_end' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'working_hours_start' => 'required|date_format:H:i',
            'working_hours_end' => 'required|date_format:H:i',
            'google_maps_url' => 'nullable|string',
        ]);

        // Parsing: jika user paste kode <iframe>, ambil src-nya saja
        if (!empty($validated['google_maps_url'])) {
            $input = $validated['google_maps_url'];

            if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
                $validated['google_maps_url'] = $matches[1];
            }
        }

        $contact->update($validated);

        return redirect()->route('admin.contact.index')->with('success', 'Data kontak berhasil diperbarui.');
    }
}
