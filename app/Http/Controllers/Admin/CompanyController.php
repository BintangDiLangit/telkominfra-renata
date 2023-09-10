<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:view_companies'])->only('index');
        $this->middleware(['permission:add_companies'])->only('store');
        $this->middleware(['permission:edit_companies'])->only('update');
        $this->middleware(['permission:delete_companies'])->only('destroy');
    }
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.company.index')
                ->withErrors($validator)
                ->withInput();
        }
        $company = new Company();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'company' . uniqid() . strtolower(Str::random(10)) . '.' . $request->image->extension();
            $destinationPath = public_path('/storage/company_images');
            $fullPath = $destinationPath . '/' . $filename;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($fullPath, 85);

            $company->image = $filename;
        }
        $company->name = $request->input('name');
        $company->link = $request->input('link');
        $company->description = $request->input('description');
        $company->save();

        return redirect()->route('admin.company.index')
            ->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.company.index')
                ->withErrors($validator)
                ->withInput();
        }

        $company = Company::findOrFail($id);
        if ($request->hasFile('image')) {
            $oldFile = $company->image;
            $image = $request->file('image');
            $filename = 'company' . uniqid() . strtolower(Str::random(10)) . '.' . $request->image->extension();
            $destinationPath = public_path('storage/company_images');
            $fullPath = $destinationPath . '/' . $filename;
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($fullPath, 85);

            Storage::disk('public')->delete('company_images/' . $oldFile);

            $company->image = $filename;
        }
        $company->name = $request->input('name');
        $company->link = $request->input('link');
        $company->description = $request->input('description');
        $company->save();

        return redirect()->route('admin.company.index')
            ->with('success', 'Perusahaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        Storage::disk('public')->delete('company_images/' . $company->image);
        $company->delete();

        return redirect()->route('admin.company.index')
            ->with('success', 'Perusahaan berhasil dihapus.');
    }
}