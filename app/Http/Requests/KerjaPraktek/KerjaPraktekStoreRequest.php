<?php

namespace App\Http\Requests\KerjaPraktek;

use Illuminate\Foundation\Http\FormRequest;

class KerjaPraktekStoreRequest extends FormRequest
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
            'THNAKA' => ['required'],
            'Periode' => ['required'],
            'nim' => ['required', 'size:8'],
            'DOSEN_PEMB' => ['required'],
            'nmdosen' => ['required', 'string', 'max:255'],
            'judul_final' => ['required', 'string', 'max:255'],
            'link_laporan_final' => ['mimes:pdf'],
            'link_pendahuluan' => ['mimes:pdf'],
            'link_bab1' => ['mimes:pdf'],
            'link_bab2' => ['mimes:pdf'],
            'link_bab3' => ['mimes:pdf'],
            'link_bab4' => ['mimes:pdf'],
            'link_bab5' => ['mimes:pdf'],
            'link_bab6' => ['mimes:pdf'],
            'link_daftar_pustaka' => ['mimes:pdf'],
        ];
    }
}
