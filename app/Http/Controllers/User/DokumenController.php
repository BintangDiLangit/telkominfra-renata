<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Controller
{
    public function dokumen()
    {
        $dokumens = Dokumen::where('user_id', auth()->user()->id)->first();
        return view('user.pengaturan.dokumen', compact('dokumens'));
    }

    public function dokumenStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cv' => 'nullable|file|mimes:pdf,docx,xls,jpg,jpeg,png|max:10240',
            'ijazah' => 'nullable|file|mimes:pdf,docx,xls,jpg,jpeg,png|max:10240',
            'transkrip' => 'nullable|file|mimes:pdf,docx,xls,jpg,jpeg,png|max:10240',
            'skck' => 'nullable|file|mimes:pdf,docx,xls,jpg,jpeg,png|max:10240'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.dokumen')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $data = [];

            if ($request->hasFile('cv')) {
                $data['cv'] = $request->file('cv')->store('dokumen/cv', 'public');
            }

            if ($request->hasFile('ijazah')) {
                $data['ijazah'] = $request->file('ijazah')->store('dokumen/ijazah', 'public');
            }

            if ($request->hasFile('transkrip')) {
                $data['transkrip'] = $request->file('transkrip')->store('dokumen/transkrip', 'public');
            }

            if ($request->hasFile('skck')) {
                $data['skck'] = $request->file('skck')->store('dokumen/skck', 'public');
            }

            $dokumens = Dokumen::where('user_id', auth()->user()->id)->first();

            if (isset($dokumens)) {
                $dokumens->update($data);
            } else {
                $data['user_id'] =  auth()->user()->id;
                Dokumen::create($data);
            }

            DB::commit();
            return redirect()->route('pengaturan.dokumen')
                ->with('success', 'Data dokumen berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.dokumen')
                ->withErrors($th->getMessage());
        }
    }
}