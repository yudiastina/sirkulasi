<?php

namespace App\Policies;

use App\Models\TugasAkhir;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TugasAkhirPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function laporan_final(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("laporan final", explode(',' , $tugasAkhir->akses_user));
    }
    public function artikel(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("artikel", explode(',' , $tugasAkhir->akses_user));
    }
    public function pendahuluan(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("pendahuluan", explode(',' , $tugasAkhir->akses_user));
    }
    public function abstrak(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("abstrak", explode(',' , $tugasAkhir->akses_user));
    }
    public function bab1(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("bab i", explode(',' , $tugasAkhir->akses_user));
    }
    public function bab2(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("bab ii", explode(',' , $tugasAkhir->akses_user));
    }
    public function bab3(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("bab iii", explode(',' , $tugasAkhir->akses_user));
    }
    public function bab4(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("bab iv", explode(',' , $tugasAkhir->akses_user));
    }
    public function bab5(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("bab v", explode(',' , $tugasAkhir->akses_user));
    }
    public function daftar_pustaka(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("daftar pustaka", explode(',' , $tugasAkhir->akses_user));
    }
    public function lampiran(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("lampiran", explode(',' , $tugasAkhir->akses_user));
    }
    public function biodata(User $user, TugasAkhir $tugasAkhir)
    {
        return $user->role === 'admin' || in_array("biodata", explode(',' , $tugasAkhir->akses_user));
    }
}
