<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBangunanRequest extends FormRequest
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
            'call_center'       => 'required',
            'nomor_asset'       => ['required','max:30',Rule::unique('bangunan', 'nomor_asset')],
            'nama_asset'        => 'required|max:50',
            'lokasi'            => 'required',
            'luas_bangunan'     => 'nullable|numeric',
            'longitude'         => 'required',
            'latitude'          => 'required',
            'tahun_perolehan'   => 'nullable|numeric|max:4|min:4',
            'nilai_perolehan'   => 'nullable|decimal:2',
            'nilai_buku'        => 'nullable',
            'masa_berlaku_pajak'=> 'nullable',
            'keterangan'        => 'nullable',
            'file.*'            => 'mimes:pdf,jpg,png,jpeg,JPG,JPEG,PNG,PDF|max:3072'
        ];
    }

    public function messages(): array
    {
        return [
            'call_center.required'       => 'Field unit harus diisi',
            'nomor_asset.required'       => 'Field nomor asset harus diisi',
            'nomor_asset.max'            => 'Field nomor asset maksimal 30 karakter',
            'nomor_asset.unique'         => 'Nomor asset sudah terdaftar',
            'nama_asset.required'        => 'Field nama asset harus diisi',
            'nama_asset.max'             => 'Field nama asset maksimal 50 karakter',
            'lokasi.required'            => 'Field lokasi harus diisi',
            'luas_bangunan.numeric'      => 'Field luas bangunan harus numerik',
            'longitude.required'         => 'Field longitude harus diisi',
            'latitude.required'          => 'Field latitude harus diisi',
            'tahun_perolehan.numeric'    => 'Field tahun perolehan harus numerik',
            'tahun_perolehan.max'        => 'Field tahun perolehan maksimal 4 karakter',
            'tahun_perolehan.min'        => 'Field tahun perolehan minimal 4 karakter',
            'nilai_perolehan.decimal'    => 'Field nilai perolehan harus diisi desimal',
            'file.*.mimes'               => 'File yang diizinkan hanya pdf, jpg, jpeg dan png',
            'file.*.max'                 => 'Ukuran maksimal file 3MB'
        ];
    }
}
