<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KeluargaController extends Controller
{
    public function keluarga()
    {
        $keluargas = UserKeluarga::where('user_id', auth()->user()->id)->get();
        return view('user.pengaturan.keluarga', compact('keluargas'));
    }

    public function keluargaStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'hubungan_keluarga' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'alamat_lengkap' => 'required',
            'nomor_telepon' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.keluarga')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            UserKeluarga::create([
                'user_id' => auth()->user()->id,
                'hubungan' => $request->hubungan_keluarga,
                'nama' => $request->nama_lengkap,
                'pekerjaan' => $request->pekerjaan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat_lengkap,
                'nomor_telepon' => $request->nomor_telepon
            ]);
            DB::commit();
            return redirect()->route('pengaturan.keluarga')
                ->with('success', 'Data keluarga berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.keluarga')
                ->withErrors($th->getMessage());
        }
    }
    public function keluargaUpdate(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'hubungan_keluarga' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'alamat_lengkap' => 'required',
            'nomor_telepon' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.keluarga')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $userKeluarga = UserKeluarga::find($id);
            $userKeluarga->update([
                'user_id' => auth()->user()->id,
                'hubungan' => $request->hubungan_keluarga,
                'nama' => $request->nama_lengkap,
                'pekerjaan' => $request->pekerjaan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat_lengkap,
                'nomor_telepon' => $request->nomor_telepon
            ]);
            DB::commit();
            return redirect()->route('pengaturan.keluarga')
                ->with('success', 'Data keluarga berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.keluarga')
                ->withErrors($th->getMessage());
        }
    }

    public function keluargaDelete($id)
    {
        try {
            $userKeluarga = UserKeluarga::find($id);
            $userKeluarga->delete();
            return redirect()->route('pengaturan.keluarga')
                ->with('success', 'Data keluarga berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.keluarga')
                ->withErrors($th->getMessage());
        }
    }
}
