<?php

namespace App\Http\Controllers\Admin;

use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TugasAkhir\TugasAkhirStoreRequest;
use App\Http\Requests\TugasAkhir\TugasAkhirUpdateRequest;

class TugasAkhirController extends Controller
{
    public function index()
    {
        return response()->view('admin.tugas_akhir.index');
    }

    public function create()
    {
        return response()->view('admin.tugas_akhir.create');
    }
    public function store(TugasAkhirStoreRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('link_laporan_final')) {
            $fileName = 'laporan_final-'.$request->NIM.'-' . time() . '.'.$request->link_laporan_final->extension();
            $path = $request->NIM.'/dokumen_final';
            $validatedData['link_laporan_final'] = $request->file('link_laporan_final')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_artikel')) {
            $fileName = 'artikel-' .$request->NIM.'-' . time() .  '.' . $request->link_artikel->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_artikel'] = $request->file('link_artikel')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_pendahuluan')) {
            $fileName = 'pendahuluan-' .$request->NIM.'-' . time() .  '.' . $request->link_pendahuluan->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_pendahuluan'] = $request->file('link_pendahuluan')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_abstrak')) {
            $fileName = 'abstrak-' .$request->NIM.'-' . time() .  '.' . $request->link_abstrak->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_abstrak'] = $request->file('link_abstrak')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab1')) {
            $fileName = 'bab1-' .$request->NIM.'-' . time() .  '.' . $request->link_bab1->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_bab1'] = $request->file('link_bab1')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab2')) {
            $fileName = 'bab2-' .$request->NIM.'-' . time() .  '.' . $request->link_bab2->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_bab2'] = $request->file('link_bab2')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab3')) {
            $fileName = 'bab3-' .$request->NIM.'-' . time() .  '.' . $request->link_bab3->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_bab3'] = $request->file('link_bab3')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab4')) {
            $fileName = 'bab4-' .$request->NIM.'-' . time() .  '.' . $request->link_bab4->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_bab4'] = $request->file('link_bab4')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab5')) {
            $fileName = 'bab5-' .$request->NIM.'-' . time() .  '.' . $request->link_bab5->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_bab5'] = $request->file('link_bab5')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_daftar_pustaka')) {
            $fileName = 'daftar_pustaka-' .$request->NIM.'-' . time() .  '.' . $request->link_daftar_pustaka->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_daftar_pustaka'] = $request->file('link_daftar_pustaka')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_lampiran')) {
            $fileName = 'lampiran-' .$request->NIM.'-' . time() .  '.' . $request->link_lampiran->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_lampiran'] = $request->file('link_lampiran')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_biodata')) {
            $fileName = 'biodata-' .$request->NIM.'-' . time() .  '.' . $request->link_biodata->extension();
            $path = $request->NIM . '/dokumen_final';
            $validatedData['link_biodata'] = $request->file('link_biodata')
                ->storeAs($path, $fileName, 'public');
        }
        $validatedData['akses_user'] = implode(',', $request->input('akses_user'));
        TugasAkhir::create($validatedData);
        return redirect()->route('admin.ta.index');
    }

    public function edit(TugasAkhir $tugasAkhir)
    {
        return response()->view('admin.tugas_akhir.edit', [
            'tugasAkhir' => $tugasAkhir,
            'akses_user' => explode(',' , $tugasAkhir->akses_user),
        ]);
    }

    public function update(TugasAkhirUpdateRequest $request, TugasAkhir $tugasAkhir)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('link_laporan_final')) {
            if($request->old_link_laporan_final){
                Storage::disk('public')->delete($request->old_link_laporan_final);
            }
            $fileName = 'laporan_final-'.$tugasAkhir->NIM.'.'.$request->link_laporan_final->extension();
            $path = $tugasAkhir->NIM.'/dokumen_final';
            $validatedData['link_laporan_final'] = $request->file('link_laporan_final')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_artikel')) {
            if($request->old_link_artikel){
                Storage::disk('public')->delete($request->old_link_artikel);
            }
            $fileName = 'artikel-'.$tugasAkhir->NIM.'.'.$request->link_artikel->extension();
            $path = $tugasAkhir->NIM.'/dokumen_final';
            $validatedData['link_artikel'] = $request->file('link_artikel')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_pendahuluan')) {
            if ($request->old_link_pendahuluan) {
                Storage::disk('public')->delete($request->old_link_pendahuluan);
            }
            $fileName = 'pendahuluan-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_pendahuluan->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_pendahuluan'] = $request->file('link_pendahuluan')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_abstrak')) {
            if ($request->old_link_abstrak) {
                Storage::disk('public')->delete($request->old_link_abstrak);
            }
            $fileName = 'abstrak-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_abstrak->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_abstrak'] = $request->file('link_abstrak')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab1')) {
            if ($request->old_link_bab1) {
                Storage::disk('public')->delete($request->old_link_bab1);
            }
            $fileName = 'bab1-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_bab1->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_bab1'] = $request->file('link_bab1')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab2')) {
            if ($request->old_link_bab2) {
                Storage::disk('public')->delete($request->old_link_bab2);
            }
            $fileName = 'bab2-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_bab2->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_bab2'] = $request->file('link_bab2')
                ->storeAs($path, $fileName, 'public');
        }

        if ($request->hasFile('link_bab3')) {
            if ($request->old_link_bab3) {
                Storage::disk('public')->delete($request->old_link_bab3);
            }
            $fileName = 'bab3-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_bab3->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_bab3'] = $request->file('link_bab3')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab4')) {
            if ($request->old_link_bab4) {
                Storage::disk('public')->delete($request->old_link_bab4);
            }
            $fileName = 'bab4-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_bab4->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_bab4'] = $request->file('link_bab4')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_bab5')) {
            if ($request->old_link_bab5) {
                Storage::disk('public')->delete($request->old_link_bab5);
            }
            $fileName = 'bab5-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_bab5->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_bab5'] = $request->file('link_bab5')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_daftar_pustaka')) {
            if ($request->old_link_daftar_pustaka) {
                Storage::disk('public')->delete($request->old_link_daftar_pustaka);
            }
            $fileName = 'daftar_pustaka-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_daftar_pustaka->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_daftar_pustaka'] = $request->file('link_daftar_pustaka')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_lampiran')) {
            if ($request->old_link_lampiran) {
                Storage::disk('public')->delete($request->old_link_lampiran);
            }
            $fileName = 'lampiran-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_lampiran->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_lampiran'] = $request->file('link_lampiran')
                ->storeAs($path, $fileName, 'public');
        }
        if ($request->hasFile('link_biodata')) {
            if ($request->old_link_biodata) {
                Storage::disk('public')->delete($request->old_link_biodata);
            }
            $fileName = 'biodata-' .$tugasAkhir->NIM.'-' . time() .  '.' . $request->link_biodata->extension();
            $path = $tugasAkhir->NIM . '/dokumen_final';
            $validatedData['link_biodata'] = $request->file('link_biodata')
                ->storeAs($path, $fileName, 'public');
        }
        $validatedData['akses_user'] = implode(',' , $request->input('akses_user'));

        TugasAkhir::where('id', $tugasAkhir->id)
                    ->update($validatedData);
        return redirect()->route('admin.ta.index');
    }

    public function show(TugasAkhir $tugasAkhir)
    {
        return response()->view('admin.tugas_akhir.show', [
            'tugasAkhir' => $tugasAkhir,
            'akses_user' => explode(',' , $tugasAkhir->akses_user),
        ]);
    }

    public function destroy(TugasAkhir $tugasAkhir)
    {
        $directory = $tugasAkhir->NIM.'/dokumen_final';
        Storage::disk('public')->deleteDirectory($directory);
        TugasAkhir::destroy($tugasAkhir->id);
        return redirect()->route('admin.ta.index');
    }
}
