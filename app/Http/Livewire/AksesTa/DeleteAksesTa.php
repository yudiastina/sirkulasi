<?php

namespace App\Http\Livewire\AksesTa;

use App\Models\AksesTugasAkhir;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteAksesTa extends ModalComponent
{
    public $aksesTugasAkhirId;
    
    public function mount($aksesTugasAkhirId)
    {
        $this->aksesTugasAkhirId = $aksesTugasAkhirId;
    }

    public function render()
    {
        return view('livewire.akses-ta.delete-akses-ta');
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

    public function destroy($aksesTugasAkhirId)
    {
        AksesTugasAkhir::destroy($aksesTugasAkhirId);
        $this->closeModalWithEvents([
            $this->emit('pg:eventRefresh-default')
        ]);
    }
}
