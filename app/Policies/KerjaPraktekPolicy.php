<?php

namespace App\Policies;

use App\Models\KerjaPraktek;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KerjaPraktekPolicy
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

    public function laporan_final(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("laporan final", explode(',' , $kerjaPraktek->akses_user));
    }
    public function pendahuluan(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("pendahuluan", explode(',' , $kerjaPraktek->akses_user));
    }
    public function bab1(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("bab i", explode(',' , $kerjaPraktek->akses_user));
    }
    public function bab2(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("bab ii", explode(',' , $kerjaPraktek->akses_user));
    }
    public function bab3(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("bab iii", explode(',' , $kerjaPraktek->akses_user));
    }
    public function bab4(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("bab iv", explode(',' , $kerjaPraktek->akses_user));
    }
    public function bab5(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("bab v", explode(',' , $kerjaPraktek->akses_user));
    }
    public function bab6(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("bab vi", explode(',' , $kerjaPraktek->akses_user));
    }
    public function daftar_pustaka(User $user, KerjaPraktek $kerjaPraktek)
    {
        return $user->role === 'admin' || in_array("daftar pustaka", explode(',' , $kerjaPraktek->akses_user));
    }
}
