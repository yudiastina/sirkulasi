<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjaPraktek extends Model
{
    use HasFactory;

    protected $fillable = [
        'THNAKA',
        'Periode',
        'nim',
        'DOSEN_PEMB',
        'nmdosen',
        'judul_final',
        'link_laporan_final',
        'link_pendahuluan',
        'link_bab1',
        'link_bab2',
        'link_bab3',
        'link_bab4',
        'link_bab5',
        'link_bab6',
        'link_daftar_pustaka',
        'akses_user',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul_final', 'like', '%' . $search . '%')
            ->orWhere('nmdosen', 'like', '%' . $search . '%')
            ->orWhere('nim', 'like', '%' . $search . '%');
        });

        $query->when($filters['judul'] ?? false, function ($query, $judul) {
            return $query->where('judul_final', 'like', '%' . $judul . '%');
        })->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->where('THNAKA', 'like', '%' . $tahun . '%')
                ->orWhere('Periode', 'like', '%' . $tahun . '%');
        })->when($filters['tempat_kp'] ?? false, function ($query, $tempat_kp) {
            return $query->where('tempat_kp', 'like', '%' . $tempat_kp . '%');
        })->when($filters['pembimbing'] ?? false, function ($query, $pembimbing) {
            return $query->where('Pembimbing1', 'like', '%' . $pembimbing . '%');
        });
    }

    public function akses_kerja_prakteks()
    {
        return $this->hasMany(AksesKerjaPraktek::class);
    }
}
