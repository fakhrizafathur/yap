<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Provinsi;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;

/**
 * PersonController
 * 
 * Menangani CRUD operations untuk data Person (orang).
 * Menyediakan fitur list, create, edit, delete dengan search dan filter.
 * 
 * @author Development Team
 * @version 1.0
 */
class PersonController extends Controller
{
    /**
     * Display a paginated list of persons dengan opsi search dan filter.
     * 
     * Menampilkan daftar semua person dengan:
     * - Search berdasarkan NIK atau Nama
     * - Filter berdasarkan Provinsi
     * - Pagination 10 items per halaman
     * 
     * Query Parameters:
     * - search: string untuk mencari NIK atau Nama
     * - provinsi_id: ID provinsi untuk filter
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = Person::with('provinsi');
        
        // Search by NIK or Nama
        if ($search = request('search')) {
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
        }
        
        // Filter by Provinsi
        if ($provinsiId = request('provinsi_id')) {
            $query->where('provinsi_id', $provinsiId);
        }
        
        $people = $query->paginate(10);
        $provinsis = Provinsi::all();
        
        return view('persons.index', compact('people', 'provinsis'));
    }

    /**
     * Show the form untuk membuat person baru.
     * 
     * Menampilkan form create dengan dropdown daftar semua provinsi.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        return view('persons.create', compact('provinsis'));
    }

    /**
     * Store a newly created person dalam database.
     * 
     * Menyimpan data person baru setelah validasi dari StorePersonRequest.
     * Redirect ke dashboard dengan success message setelah berhasil.
     * 
     * @param StorePersonRequest $request Data person yang sudah divalidasi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePersonRequest $request)
    {
        Person::create($request->validated());
        return redirect()->route('dashboard')->with('success', 'Person berhasil ditambahkan.');
    }

    /**
     * Show the form untuk edit person yang ada.
     * 
     * Menampilkan form edit dengan data person dan dropdown provinsi.
     * 
     * @param Person $person Person yang akan diedit (injected via route model binding)
     * @return \Illuminate\View\View
     */
    public function edit(Person $person)
    {
        $provinsis = Provinsi::all();
        return view('persons.edit', compact('person', 'provinsis'));
    }

    /**
     * Update data person yang ada dalam database.
     * 
     * Memperbarui data person setelah validasi dari UpdatePersonRequest.
     * Redirect ke dashboard dengan success message setelah berhasil.
     * 
     * @param UpdatePersonRequest $request Data person yang sudah divalidasi
     * @param Person $person Person yang akan diupdate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        $person->update($request->validated());
        return redirect()->route('dashboard')->with('success', 'Person berhasil diperbarui.');
    }

    /**
     * Delete person dari database.
     * 
     * Menghapus record person dan redirect ke dashboard dengan success message.
     * 
     * @param Person $person Person yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('dashboard')->with('success', 'Person berhasil dihapus.');
    }
}