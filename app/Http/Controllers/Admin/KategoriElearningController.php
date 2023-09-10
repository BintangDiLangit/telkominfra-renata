<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriElearning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class KategoriElearningController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view_kategori_elearning'])->only('index');
        $this->middleware(['permission:add_kategori_elearning'])->only('store');
        $this->middleware(['permission:edit_kategori_elearning'])->only('update');
        $this->middleware(['permission:delete_kategori_elearning'])->only('destroy');
    }
    public function index()
    {
        $kategoriElearnings = KategoriElearning::all();
        return view('admin.kategori_elearning.index', compact('kategoriElearnings'));
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
            $destinationPath = public_path('/storage/kategori_elearning_images');
            $fullPath = $destinationPath . '/' . $filename;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($fullPath, 85);

            KategoriElearning::create([
                'name' => $request->input('name'),
                'image' => $filename,
            ]);
        }

        return redirect()->route('admin.kategori_lowongan.index')
            ->with('success', 'Kategori lowongan berhasil ditambahkan.');
    }

    public function update(Request $request, KategoriElearning $kategoriElearning)
    {
        //
    }


    public function destroy(KategoriElearning $kategoriElearning)
    {
        //
    }
}
