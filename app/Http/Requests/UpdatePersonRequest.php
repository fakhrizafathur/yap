<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * UpdatePersonRequest
 * 
 * Form Request untuk validasi data saat mengupdate person yang sudah ada.
 * Memastikan hanya user yang authenticated yang dapat update person.
 * 
 * Validasi Rules:
 * - nik: required, numeric, unique (kecuali untuk record yang sedang diedit)
 * - nama: required, string, max 255 karakter
 * - provinsi_id: required, exists di tabel provinsis
 * 
 * @author Development Team
 * @version 1.0
 */
class UpdatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * Hanya user yang sudah login (authenticated) yang bisa update person.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * Mendefinisikan rules validasi untuk update person:
     * - NIK harus diisi, berupa angka, dan unique (mengecualikan ID person yang sedang diedit)
     * - Nama harus diisi, berupa text, maksimal 255 karakter
     * - Provinsi harus dipilih dan harus ada di database
     * 
     * Perbedaan dengan StorePersonRequest: NIK unique rule mengecualikan person ID saat ini
     * agar user bisa menyimpan form tanpa mengubah NIK.
     * 
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $personId = $this->route('person')?->id;
        return [
            'nik' => 'required|numeric|unique:people,nik,' . $personId,
            'nama' => 'required|string|max:255',
            'provinsi_id' => 'required|exists:provinsis,id',
        ];
    }

    /**
     * Get custom messages for validation errors.
     * 
     * Menampilkan pesan error dalam bahasa Indonesia agar mudah dipahami user.
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nik.required' => 'NIK harus diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'provinsi_id.required' => 'Provinsi harus dipilih.',
            'provinsi_id.exists' => 'Provinsi yang dipilih tidak valid.',
        ];
    }
}
