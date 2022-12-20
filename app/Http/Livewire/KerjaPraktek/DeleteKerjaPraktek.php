<?php

namespace App\Http\Livewire\KerjaPraktek;

use Livewire\Component;
use App\Models\KerjaPraktek;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class DeleteKerjaPraktek extends ModalComponent
{
    public $kerjaPraktekId;

    public function mount($kerjaPraktekId)
    {
        $this->kerjaPraktekId = $kerjaPraktekId;
    }

    public function render()
    {
        return view('livewire.kerja-praktek.delete-kerja-praktek');
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

    public function destroy($kerjaPraktekId)
    {
        $data = KerjaPraktek::find($kerjaPraktekId);
        Storage::disk('public')->deleteDirectory($data->NIM . '/dokumen_final_kp');
        KerjaPraktek::destroy($kerjaPraktekId);
        $this->closeModalWithEvents([
            $this->emit('pg:eventRefresh-default')
        ]);
    }
}
