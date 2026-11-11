<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFooterSettingController extends Controller
{

    public function edit()
    {
        $footer = FooterSetting::find(1);

        if (!$footer) {
            $footer = new FooterSetting();

            $footer->id = 1;
            $footer->nama_puskesmas = 'Puskesmas Singaparna';
            $footer->alamat = 'Jl. Singgasari, Kecamatan Singaparna, Kabupaten Tasikmalaya, Jawa Barat 46412';
            $footer->email = 'puskesmassingaparna@gmail.com';
            $footer->copyright = '© Copyright Puskesmas Singaparna';
            $footer->kredit = 'Crafted by Gojan Abdullah';

            $footer->pintasan = [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Tentang Kami', 'url' => '/profil'],
                ['label' => 'Pelayanan', 'url' => '/pelayanan/poli-umum'],
                ['label' => 'Informasi', 'url' => '/informasi/berita'],
                ['label' => 'Promkes', 'url' => '/promkes'],
                ['label' => 'Kontak', 'url' => '/layanan-pengaduan'],
            ];

            $footer->tautan_terkait = [
                ['label' => 'Survei Kepuasan Pasien', 'url' => '#'],
                ['label' => 'Formulir Online', 'url' => '#'],
                ['label' => 'Dokter & Jadwal', 'url' => '/informasi/jadwal'],
                ['label' => 'Skrining Kesehatan', 'url' => '#'],
            ];

            $footer->save();
        }

        return view('admin.footer.edit', compact('footer'));
    }


    public function update(Request $request)
    {
        $footer = FooterSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'nama_puskesmas' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:2000',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'copyright' => 'nullable|string|max:255',
            'kredit' => 'nullable|string|max:255',
            'pintasan' => 'nullable|array',
            'pintasan.*.label' => 'nullable|string|max:100',
            'pintasan.*.url' => 'nullable|string|max:500',
            'tautan_terkait' => 'nullable|array',
            'tautan_terkait.*.label' => 'nullable|string|max:100',
            'tautan_terkait.*.url' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('logo')) {
            if ($footer->logo) {
                Storage::disk('public')->delete($footer->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('footer', 'public');
        }

        foreach (['pintasan', 'tautan_terkait'] as $field) {
            $validated[$field] = collect($request->input($field, []))
                ->filter(
                    fn($item) =>
                        !empty(trim($item['label'] ?? '')) &&
                        !empty(trim($item['url'] ?? ''))
                )
                ->map(fn($item) => [
                    'label' => trim($item['label']),
                    'url' => trim($item['url']),
                ])
                ->values()
                ->all();
        }

        $footer->fill($validated)->save();

        return redirect()
            ->route('admin.footer.edit')
            ->with('success', 'Pengaturan footer berhasil diperbarui.');
    }
}
