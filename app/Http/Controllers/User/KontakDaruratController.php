<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserKontakDarurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KontakDaruratController extends Controller
{
    public function kontakDarurat()
    {
        $kontakDarurats = UserKontakDarurat::where('user_id', auth()->user()->id)->get();
        return view('user.pengaturan.kontak-darurat', compact('kontakDarurats'));
    }

    public function kontakDaruratStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'hubungan' => 'required|max:255',
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'nomor_telepon' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.kontak.darurat')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            UserKontakDarurat::create([
                'user_id' => auth()->user()->id,
                'hubungan' => $request->hubungan,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon
            ]);
            DB::commit();
            return redirect()->route('pengaturan.kontak.darurat')
                ->with('success', 'Data kontak berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.kontak.darurat')
                ->withErrors($th->getMessage());
        }
    }

    public function kontakDaruratUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hubungan' => 'required|max:255',
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'nomor_telepon' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.kontak.darurat')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $userKontakDarurat = UserKontakDarurat::find($id);
            $userKontakDarurat->update([
                'user_id' => auth()->user()->id,
                'hubungan' => $request->hubungan,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon
            ]);
            DB::commit();
            return redirect()->route('pengaturan.kontak.darurat')
                ->with('success', 'Data kontak berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.kontak.darurat')
                ->withErrors($th->getMessage());
        }
    }

    public function kontakDaruratDelete($id)
    {
        try {
            $userKontakDarurat = UserKontakDarurat::find($id);
            $userKontakDarurat->delete();
            return redirect()->route('pengaturan.kontak.darurat')
                ->with('success', 'Data kontak berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.kontak.darurat')
                ->withErrors($th->getMessage());
        }
    }
}
