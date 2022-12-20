<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesTugasAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_akhir_id',
        'user_id',
        'nim',
        'nama',
        'prodi',
        'judul',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tugas_akhir()
    {
        return $this->belongsTo(TugasAkhir::class);
    }

}
