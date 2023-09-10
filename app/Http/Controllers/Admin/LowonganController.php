<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\KategoriLowongan;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:view_lowongans'])->only('index');
        $this->middleware(['permission:add_lowongans'])->only('store');
        $this->middleware(['permission:edit_lowongans'])->only('update');
        $this->middleware(['permission:delete_lowongans'])->only('destroy');
    }
    public function index()
    {
        $kategoriLowongans = KategoriLowongan::all();
        $lowongans = Lowongan::with('kategoriLowongan', 'company')->get();
        $companies = Company::all();
        return view('admin.lowongan.index', compact('kategoriLowongans', 'lowongans', 'companies'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|numeric',
            'judul' => 'required|max:255|string',
            'lokasi' => 'required|max:255|string',
            'companies' => 'required|numeric',
            'deskripsi' => 'string|required',
            'experience' => 'string|required',
            'range_gaji' => 'string|nullable',
            'status' => 'string|required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.lowongan.index')
                ->withErrors($validator)
                ->withInput();
        }

        Lowongan::create([
            'kategori_lowongans' => $request->input('kategori'),
            'judul' => $request->input('judul'),
            'lokasi' => $request->input('lokasi'),
            'companies' => $request->input('companies'),
            'deskripsi' => $request->input('deskripsi'),
            'experience' => $request->input('experience'),
            'range_gaji' => $request->input('range_gaji'),
            'status' => $request->input('status')
        ]);

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|numeric',
            'judul' => 'required|max:255|string',
            'lokasi' => 'required|max:255|string',
            'companies' => 'required|numeric',
            'deskripsi' => 'string|required',
            'experience' => 'string|required',
            'range_gaji' => 'string|nullable',
            'status' => 'string|required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.lowongan.index')
                ->withErrors($validator)
                ->withInput();
        }

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update([
            'kategori_lowongans' => $request->input('kategori'),
            'judul' => $request->input('judul'),
            'lokasi' => $request->input('lokasi'),
            'companies' => $request->input('companies'),
            'deskripsi' => $request->input('deskripsi'),
            'experience' => $request->input('experience'),
            'range_gaji' => $request->input('range_gaji'),
            'status' => $request->input('status')
        ]);

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}