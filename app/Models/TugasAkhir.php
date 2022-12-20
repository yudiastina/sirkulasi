<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'THNAKA',
        'Periode',
        'NIM',
        'dsnid_pemb1',
        'Pembimbing1',
        'dsnid_pemb2',
        'Pembimbing2',
        'judul_final',
        'judul_final_eng',
        'abstrak',
        'abstrak_eng',
        'kata_kunci',
        'kata_kunci_eng',
        'link_laporan_final',
        'link_artikel',
        'link_pendahuluan',
        'link_abstrak',
        'link_bab1',
        'link_bab2',
        'link_bab3',
        'link_bab4',
        'link_bab5',
        'link_daftar_pustaka',
        'link_lampiran',
        'link_biodata',
        'akses_user',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul_final', 'like', '%' . $search . '%')
                ->orWhere('judul_final_eng', 'like', '%' . $search . '%')
                ->orWhere('NIM', 'like', '%' . $search . '%')
                ->orWhere('kata_kunci', 'like', '%' . $search . '%')
                ->orWhere('kata_kunci_eng', 'like', '%' . $search . '%')
                ->orWhere('abstrak_eng', 'like', '%' . $search . '%')
                ->orWhere('abstrak_eng', 'like', '%' . $search . '%');
        });

        $query->when($filters['judul'] ?? false, function ($query, $judul) {
            return $query->where('judul_final', 'like', '%' . $judul . '%')
                ->orWhere('judul_final_eng', 'like', '%' . $judul . '%');
        })->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->where('THNAKA', 'like', '%' . $tahun . '%')
                ->orWhere('Periode', 'like', '%' . $tahun . '%');
        })->when($filters['kata_kunci'] ?? false, function ($query, $kata_kunci) {
            return $query->where('kata_kunci', 'like', '%' . $kata_kunci . '%')
                ->orWhere('kata_kunci_eng', 'like', '%' . $kata_kunci . '%');
        })->when($filters['abstrak'] ?? false, function ($query, $abstrak) {
            return $query->where('abstrak', 'like', '%' . $abstrak . '%')
                ->orWhere('abstrak_eng', 'like', '%' . $abstrak . '%');
        })->when($filters['pembimbing'] ?? false, function ($query, $pembimbing) {
            return $query->where('Pembimbing1', 'like', '%' . $pembimbing . '%')
                ->orWhere('Pembimbing2', 'like', '%' . $pembimbing . '%');
        });
    }

    public function akses_tugas_akhirs()
    {
        return $this->hasMany(AksesTugasAkhir::class);
    }
}
