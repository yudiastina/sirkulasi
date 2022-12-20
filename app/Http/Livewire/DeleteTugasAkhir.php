<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TugasAkhir;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class DeleteTugasAkhir extends ModalComponent
{
    public $tugasAkhirId;
    public $data;

    public function mount()
    {
        $data = TugasAkhir::find($this->tugasAkhirId);
        $this->data = $data;
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

    public function render()
    {
        return view('livewire.delete-tugas-akhir');
    }

    public function destroy($tugasAkhirId)
    {
        $data = TugasAkhir::find($tugasAkhirId);
        Storage::disk('public')->deleteDirectory($data->NIM . '/dokumen_final');
        TugasAkhir::destroy($tugasAkhirId);
        $this->closeModalWithEvents([
            $this->emit('pg:eventRefresh-default')
        ]);
    }
}
