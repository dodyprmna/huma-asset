<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nip'       => ['required','max:50',Rule::unique('pegawai', 'nip')->ignore($this->id_pegawai, 'id_pegawai')],
            'nama'      => 'required|max:70',
            'unit'      => 'required',
            'email'     => ['required','email','max:40',Rule::unique('pegawai', 'email')->ignore($this->id_pegawai, 'id_pegawai')],
            'level'     => 'required',
            'telepon'   => 'max:15',
            'alamat'    => 'max:225',
        ];
    }

    public function messages(): array
    {
        return [
                'nip.required'      => 'Field NIP harus diisi.',
                'nip.unique'        => 'NIP sudah terdaftar',
                'nama.required'     => 'Field nama harus diisi',
                'unit.required'     => 'Field unit harus diisi.',
                'email.required'    => 'Field email harus diisi.',
                'email.email'       => 'Field email tidak valid',
                'email.max'         => 'Field email maksimal 40 karakter',
                'email.unique'      => 'Email sudah terdaftar',
                'telepon.max'       => 'Field telepon maksimal 15 karakter',
                'alamat.max'        => 'Field alamat maksimal 225 karakter'
        ];
    }
}
