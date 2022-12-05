<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiskonRequest extends FormRequest
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
            'barang_id'=> ['required'],
            'diskon'=> ['required', 'numeric'],
            'tgl_mulai'=> ['required', 'date'],
            'tgl_akhir'=> ['required', 'date'],
        ];
    }
}
