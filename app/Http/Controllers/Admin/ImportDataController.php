<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ImportDataController extends Controller
{
    public function import_data_ta()
    {
        set_time_limit(0);
        DB::connection('mysql2')->table('tugas_akhirs')->orderBy('id')->lazy()->each(function ($data) {
            if (DB::connection('mysql')->table('tugas_akhirs')->where('NIM', $data->NIM)->doesntExist()) {
                DB::connection('mysql')->table('tugas_akhirs')->insert([
                    'THNAKA' => $data->THNAKA,
                    'Periode' => $data->Periode,
                    'NIM' => $data->NIM,
                    'dsnid_pemb1' => $data->dsnid_pemb1,
                    'Pembimbing1' => $data->Pembimbing1,
                    'dsnid_pemb2' => $data->dsnid_pemb2,
                    'Pembimbing2' => $data->Pembimbing2,
                    'judul_final' => $data->judul_final,
                    'judul_final_eng' => $data->judul_final_eng,
                    'abstrak' => $data->abstrak,
                    'abstrak_eng' => $data->abstrak_eng,
                    'kata_kunci' => $data->kata_kunci,
                    'kata_kunci_eng' => $data->kata_kunci_eng,
                    'link_laporan_final' => $data->link_laporan_final,
                    'link_artikel' => $data->link_artikel,
                    'link_pendahuluan' => $data->link_pendahuluan,
                    'link_abstrak' => $data->link_abstrak,
                    'link_bab1' => $data->link_bab1,
                    'link_bab2' => $data->link_bab2,
                    'link_bab3' => $data->link_bab3,
                    'link_bab4' => $data->link_bab4,
                    'link_bab5' => $data->link_bab5,
                    'link_daftar_pustaka' => $data->link_daftar_pustaka,
                    'link_lampiran' => $data->link_lampiran,
                    'link_biodata' => $data->link_biodata,
                ]);
            }
        });
        return redirect()->route('admin.ta.index');
    }

    public function import_data_kp()
    {
        set_time_limit(0);
        DB::connection('mysql2')->table('kerja_prakteks')->orderBy('id')->lazy()->each(function ($data) {
            if (DB::connection('mysql')->table('kerja_prakteks')->where('nim', $data->nim)->doesntExist()) {
                if (
                    $data->judul_final and $data->link_laporan_final and $data->link_pendahuluan
                    and $data->link_bab1 and $data->link_bab2 and $data->link_bab3 and $data->link_bab4
                    and $data->link_bab5 and $data->link_bab6 and $data->link_daftar_pustaka
                ) {
                    DB::connection('mysql')->table('kerja_prakteks')->insert([
                        'THNAKA' => $data->THNAKA,
                        'Periode' => $data->Periode,
                        'nim' => $data->nim,
                        'DOSEN_PEMB' => $data->DOSEN_PEMB,
                        'nmdosen' => $data->nmdosen,
                        'judul_final' => $data->judul_final,
                        'link_laporan_final' => $data->link_laporan_final,
                        'link_pendahuluan' => $data->link_pendahuluan,
                        'link_bab1' => $data->link_bab1,
                        'link_bab2' => $data->link_bab2,
                        'link_bab3' => $data->link_bab3,
                        'link_bab4' => $data->link_bab4,
                        'link_bab5' => $data->link_bab5,
                        'link_bab6' => $data->link_bab6,
                        'link_daftar_pustaka' => $data->link_daftar_pustaka,
                    ]);
                }
            }
        });
        return redirect()->route('admin.kp.index');
    }

    public function import_user(Request $request)
    {
        $users = User::pluck('NIM')->toArray();
        $usersArray = [];
        $now = now()->toDateTimeString();
        $file = fopen($request->csv_file->getRealPath(), 'r');
        while($csvLine = fgetcsv($file)) {
            if(!in_array($csvLine[1], $users)){
                $usersArray[] = [
                    'nama' => $csvLine[0],
                    'NIM' => $csvLine[1],
                    'prodi' => $csvLine[2],
                    'password' => Hash::make($csvLine[1]),
                    'created_at' => $now,
                ];
            }
            
        }
        foreach(array_chunk($usersArray, 1000) as $chuck){
            User::insert($chuck);
        }
        return redirect()->route('admin.users.index');
    }
}
