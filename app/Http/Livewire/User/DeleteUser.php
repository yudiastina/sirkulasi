<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteUser extends ModalComponent
{
    public $userId;
    
    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function render()
    {
        return view('livewire.user.delete-user');
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function cancel()
    {
        $this->closeModalWithEvents([
            $this->emit('pg:eventRefresh-default')
        ]);
    }

    public function destroy($userId)
    {
        $data = User::find($userId);

        if($data->role !== 'admin') {
            User::destroy($data->id);
        }

        $this->closeModalWithEvents([
            $this->emit('pg:eventRefresh-default')
        ]);
    }
}
