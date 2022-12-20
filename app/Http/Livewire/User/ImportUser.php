<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;

class ImportUser extends ModalComponent
{
    public function render()
    {
        return view('livewire.user.import-user');
    }
}
