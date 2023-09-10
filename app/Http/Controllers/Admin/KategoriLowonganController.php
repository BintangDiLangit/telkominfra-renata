<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriLowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class KategoriLowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view_kategori_lowongans'])->only('index');
        $this->middleware(['permission:add_kategori_lowongans'])->only('store');
        $this->middleware(['permission:edit_kategori_lowongans'])->only('update');
        $this->middleware(['permission:delete_kategori_lowongans'])->only('destroy');
    }
    public function index()
    {
        $kategoriLowongans = KategoriLowongan::all();
        return view('admin.kategori_lowongan.index', compact('kategoriLowongans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kategori_lowongan.index')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'kategori_lowongan' . uniqid() . strtolower(Str::random(10)) . '.' . $request->image->extension();
            $destinationPath = public_path('/storage/kategori_lowongan_images');
            $fullPath = $destinationPath . '/' . $filename;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($fullPath, 85);

            KategoriLowongan::create([
                'name' => $request->input('name'),
                'image' => $filename,
            ]);
        }

        return redirect()->route('admin.kategori_lowongan.index')
            ->with('success', 'Kategori lowongan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kategori_lowongan.index')
                ->withErrors($validator)
                ->withInput();
        }

        $kategoriLowongan = KategoriLowongan::findOrFail($id);
        if ($request->hasFile('image')) {
            $oldFile = $kategoriLowongan->image;
            $image = $request->file('image');
            $filename = 'kategori_lowongan' . uniqid() . strtolower(Str::random(10)) . '.' . $request->image->extension();
            $destinationPath = public_path('storage/kategori_lowongan_images');
            $fullPath = $destinationPath . '/' . $filename;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($fullPath, 85);

            Storage::disk('public')->delete('kategori_lowongan_images/' . $oldFile);

            $kategoriLowongan->image = $filename;
        }
        $kategoriLowongan->name = $request->input('name');
        $kategoriLowongan->save();

        return redirect()->route('admin.kategori_lowongan.index')
            ->with('success', 'Kategori lowongan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriLowongan = KategoriLowongan::findOrFail($id);
        Storage::disk('public')->delete('kategori_lowongan_images/' . $kategoriLowongan->image);
        $kategoriLowongan->delete();

        return redirect()->route('admin.kategori_lowongan.index')
            ->with('success', 'Kategori lowongan berhasil dihapus.');
    }
}