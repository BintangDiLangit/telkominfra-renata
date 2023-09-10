<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RiwayatPekerjaanController extends Controller
{
    public function riwayatPekerjaan()
    {
        $riwayatPekerjaans = RiwayatPekerjaan::where('user_id', auth()->user()->id)->get();
        return view('user.pengaturan.riwayat-pekerjaan', compact('riwayatPekerjaans'));
    }

    public function riwayatPekerjaanStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|max:255',
            'keahlian' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'tahun_mulai' => 'required|max:255',
            'tahun_selesai' => 'required|max:255',
            'deskripsi' => 'required',
            'alamat' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            RiwayatPekerjaan::create([
                'user_id' => auth()->user()->id,
                'nama_perusahaan' => $request->nama_perusahaan,
                'keahlian' => $request->keahlian,
                'jabatan' => $request->jabatan,
                'tahun_mulai' => $request->tahun_mulai,
                'tahun_selesai' => $request->tahun_selesai,
                'deskripsi' => $request->deskripsi,
                'alamat' => $request->alamat
            ]);
            DB::commit();
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->with('success', 'Data riwayat pekerjaan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->withErrors($th->getMessage());
        }
    }
    public function riwayatPekerjaanUpdate(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required|max:255',
            'keahlian' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'tahun_mulai' => 'required|max:255',
            'tahun_selesai' => 'required|max:255',
            'deskripsi' => 'required',
            'alamat' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $riwayatPekerjaan = RiwayatPekerjaan::find($id);
            $riwayatPekerjaan->update([
                'user_id' => auth()->user()->id,
                'nama_perusahaan' => $request->nama_perusahaan,
                'keahlian' => $request->keahlian,
                'jabatan' => $request->jabatan,
                'tahun_mulai' => $request->tahun_mulai,
                'tahun_selesai' => $request->tahun_selesai,
                'deskripsi' => $request->deskripsi,
                'alamat' => $request->alamat
            ]);
            DB::commit();
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->with('success', 'Data riwayat pekerjaan berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->withErrors($th->getMessage());
        }
    }

    public function riwayatPekerjaanDelete($id)
    {
        try {
            $riwayatPekerjaan = RiwayatPekerjaan::find($id);
            $riwayatPekerjaan->delete();
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->with('success', 'Data riwayat pekerjaan berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.riwayat.pekerjaan')
                ->withErrors($th->getMessage());
        }
    }
}