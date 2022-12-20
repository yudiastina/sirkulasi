<?php

namespace App\Http\Livewire\AksesKp;

use App\Models\AksesKerjaPraktek;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteAksesKp extends ModalComponent
{
    public $aksesKerjaPraktekId;
    
    public function mount($aksesKerjaPraktekId)
    {
        $this->aksesKerjaPraktekId = $aksesKerjaPraktekId;
    }

    public function render()
    {
        return view('livewire.akses-kp.delete-akses-kp');
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

    public function destroy($aksesKerjaPraktekId)
    {
        AksesKerjaPraktek::destroy($aksesKerjaPraktekId);
        $this->closeModalWithEvents([
            $this->emit('pg:eventRefresh-default')
        ]);
    }
}
