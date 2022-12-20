<?php

namespace App\Http\Controllers\Admin;

use App\Models\KerjaPraktek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\KerjaPraktek\KerjaPraktekStoreRequest;
use App\Http\Requests\KerjaPraktek\KerjaPraktekUpdateRequest;

class KerjaPraktekController extends Controller
{
    public function index()
    {
        return response()->view('admin.kerja_praktek.index');
    }

    public function create()
    {
        return response()->view('admin.kerja_praktek.create');
    }

    public function store(KerjaPraktekStoreRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('link_laporan_final')) {
            $fileName = 'laporan_final-' .$request->nim.'-' . time() .  '.' . $request->link_laporan_final->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_laporan_final'] = $request->file('link_laporan_final')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_pendahuluan')) {
            $fileName = 'pendahuluan-' .$request->nim.'-' . time() .  '.' . $request->link_pendahuluan->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_pendahuluan'] = $request->file('link_pendahuluan')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab1')) {
            $fileName = 'bab1-' .$request->nim.'-' . time() .  '.' . $request->link_bab1->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_bab1'] = $request->file('link_bab1')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab2')) {
            $fileName = 'bab2-' .$request->nim.'-' . time() .  '.' . $request->link_bab2->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_bab2'] = $request->file('link_bab2')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab3')) {
            $fileName = 'bab3-' .$request->nim.'-' . time() .  '.' . $request->link_bab3->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_bab3'] = $request->file('link_bab3')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab4')) {
            $fileName = 'bab4-' .$request->nim.'-' . time() .  '.' . $request->link_bab4->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_bab4'] = $request->file('link_bab4')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab5')) {
            $fileName = 'bab5-' .$request->nim.'-' . time() .  '.' . $request->link_bab5->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_bab5'] = $request->file('link_bab5')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab6')) {
            $fileName = 'bab6-' .$request->nim.'-' . time() .  '.' . $request->link_bab6->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_bab6'] = $request->file('link_bab6')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_daftar_pustaka')) {
            $fileName = 'daftar_pustaka-' .$request->nim.'-' . time() .  '.' . $request->link_daftar_pustaka->extension();
            $path = $request->nim . '/dokumen_final_kp';
            $validatedData['link_daftar_pustaka'] = $request->file('link_daftar_pustaka')
                ->storeAs($path, $fileName, 'public');
        }
        $validatedData['akses_user'] = implode(',', $request->input('akses_user'));
        KerjaPraktek::create($validatedData);
        return redirect()->route('admin.kp.index');
    }

    public function edit(KerjaPraktek $kerjaPraktek)
    {
        return response()->view('admin.kerja_praktek.edit', [
            'kerjaPraktek' => $kerjaPraktek,
            'akses_user' => explode(',' , $kerjaPraktek->akses_user),
        ]);
    }

    public function update(KerjaPraktekUpdateRequest $request, KerjaPraktek $kerjaPraktek)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('link_laporan_final')) {
            if($request->old_link_laporan_final){
                Storage::disk('public')->delete($request->old_link_laporan_final);
            }
            $fileName = 'laporan_final-'.$kerjaPraktek->nim.'.'.$request->link_laporan_final->extension();
            $path = $kerjaPraktek->nim.'/dokumen_final_kp';
            $validatedData['link_laporan_final'] = $request->file('link_laporan_final')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_pendahuluan')) {
            if ($request->old_link_pendahuluan) {
                Storage::disk('public')->delete($request->old_link_pendahuluan);
            }
            $fileName = 'pendahuluan-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_pendahuluan->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_pendahuluan'] = $request->file('link_pendahuluan')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab1')) {
            if ($request->old_link_bab1) {
                Storage::disk('public')->delete($request->old_link_bab1);
            }
            $fileName = 'bab1-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_bab1->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_bab1'] = $request->file('link_bab1')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab2')) {
            if ($request->old_link_bab2) {
                Storage::disk('public')->delete($request->old_link_bab2);
            }
            $fileName = 'bab2-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_bab2->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_bab2'] = $request->file('link_bab2')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab3')) {
            if ($request->old_link_bab3) {
                Storage::disk('public')->delete($request->old_link_bab3);
            }
            $fileName = 'bab3-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_bab3->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_bab3'] = $request->file('link_bab3')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab4')) {
            if ($request->old_link_bab4) {
                Storage::disk('public')->delete($request->old_link_bab4);
            }
            $fileName = 'bab4-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_bab4->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_bab4'] = $request->file('link_bab4')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab5')) {
            if ($request->old_link_bab5) {
                Storage::disk('public')->delete($request->old_link_bab5);
            }
            $fileName = 'bab5-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_bab5->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_bab5'] = $request->file('link_bab5')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab6')) {
            if ($request->old_link_bab6) {
                Storage::disk('public')->delete($request->old_link_bab6);
            }
            $fileName = 'bab6-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_bab6->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_bab6'] = $request->file('link_bab6')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_daftar_pustaka')) {
            if ($request->old_link_daftar_pustaka) {
                Storage::disk('public')->delete($request->old_link_daftar_pustaka);
            }
            $fileName = 'daftar_pustaka-' .$kerjaPraktek->nim.'-' . time() .  '.' . $request->link_daftar_pustaka->extension();
            $path = $kerjaPraktek->nim . '/dokumen_final_kp';
            $validatedData['link_daftar_pustaka'] = $request->file('link_daftar_pustaka')
                ->storeAs($path, $fileName, 'public');
        }
        $validatedData['akses_user'] = implode(',' , $request->input('akses_user'));

        KerjaPraktek::where('id', $kerjaPraktek->id)
                    ->update($validatedData);
        return redirect()->route('admin.kp.index');
    }

    public function show(KerjaPraktek $kerjaPraktek)
    {
        return response()->view('admin.kerja_praktek.show', [
            'kerjaPraktek' => $kerjaPraktek,
            'akses_user' => explode(',' , $kerjaPraktek->akses_user)
        ]);
    }
    public function destroy(KerjaPraktek $kerjaPraktek)
    {
        $directory = $kerjaPraktek->nim.'/dokumen_final_kp';
        Storage::disk('public')->deleteDirectory($directory);
        KerjaPraktek::destroy($kerjaPraktek->id);
        return redirect()->route('admin.kp.index');
    }
}
