<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnggotaRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_lengkap'=> ['required', 'string'],
            'foto_ktp'=> ['image', 'mimes:png,jpg'],
            'pekerjaan'=> ['required', 'string'],
            'gaji'=> ['required', 'numeric'],
            'pendidikan'=> ['required', 'string'],
            'jenkel'=> ['required', 'string'],
            'tempat_lahir'=> ['required', 'string'],
            'tgl_lahir'=> ['required', 'date'],
            'status'=> ['required', 'string'],
            'tanggungan'=> ['string'],
        ];
    }
}
