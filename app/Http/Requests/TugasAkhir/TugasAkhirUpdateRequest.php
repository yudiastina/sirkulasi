<?php

namespace App\Http\Requests\TugasAkhir;

use Illuminate\Foundation\Http\FormRequest;

class TugasAkhirUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'THNAKA' => ['sometimes'],
            'NIM' => ['sometimes', 'size:8', 'unique:kerja_prakteks'],
            'Periode' => ['sometimes'],
            'dsnid_pemb1' =>['sometimes'],
            'Pembimbing1' => ['sometimes', 'string', 'max:255'],
            'dsnid_pemb2' =>['sometimes'],
            'Pembimbing2' => ['sometimes', 'string', 'max:255'],
            'judul_final' => ['sometimes', 'string', 'max:255'],
            'judul_final_eng' => ['sometimes', 'string', 'max:255'],
            'abstrak' => ['sometimes'],
            'abstrak_eng' => ['sometimes'],
            'kata_kunci' => ['sometimes', 'string', 'max:255'],
            'kata_kunci_eng' => ['sometimes', 'string', 'max:255'],
            'link_laporan_final' =>['mimes:pdf'],
            'link_artikel' =>['mimes:pdf'],
            'link_pendahuluan' =>['mimes:pdf'],
            'link_abstrak' =>['mimes:pdf'],
            'link_bab1' =>['mimes:pdf'],
            'link_bab2' =>['mimes:pdf'],
            'link_bab3' =>['mimes:pdf'],
            'link_bab4' =>['mimes:pdf'],
            'link_bab5' =>['mimes:pdf'],
            'link_daftar_pustaka' =>['mimes:pdf'],
            'link_lampiran' =>['mimes:pdf'],
            'link_biodata' =>['mimes:pdf'],
        ];
    }
}
