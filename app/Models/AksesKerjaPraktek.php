<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesKerjaPraktek extends Model
{
    use HasFactory;

    protected $fillable = [
        'kerja_praktek_id',
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

    public function kerja_praktek()
    {
        return $this->belongsTo(KerjaPraktek::class);
    }
}
