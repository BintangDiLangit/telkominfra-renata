<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserPendidikan;
use App\Models\UserPendidikanOrganisasi;
use App\Models\UserPendidikanPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class PendidikanController extends Controller
{
    public function pendidikan()
    {
        $pendidikans = UserPendidikan::with('organisasis', 'prestasis')->where('user_id', auth()->user()->id)->get();
        return view('user.pengaturan.pendidikan', compact('pendidikans'));
    }

    public function PendidikanStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_institusi' => 'required|max:255',
            'jenjang_pendidikan' => 'required|max:255',
            'jurusan' => 'required',
            'tahun_mulai_pend' => 'required|max:255',
            'tahun_selesai_pend' => 'required|max:255',
            'ipk' => 'required|max:255',
            'nama_organisasi.*' => 'nullable|max:255',
            'deskripsi_org.*' => 'nullable|max:255',
            'tahun_mulai_org.*' => 'nullable|max:255',
            'tahun_lulus_org.*' => 'nullable|max:255',
            'bukti_org.*' => 'nullable|image',
            'nama_prestasi.*' => 'nullable|max:255',
            'deskripsi_prestasi.*' => 'nullable|max:255',
            'tahun_prestasi.*' => 'nullable|max:255',
            'bukti_prestasi.*' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.pendidikan')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();


            $userPendidikan = UserPendidikan::create([
                'user_id' => auth()->user()->id,
                'nama_institusi' => $request->nama_institusi,
                'jenjang_pendidikan' => $request->jenjang_pendidikan,
                'jurusan' => $request->jurusan,
                'tahun_mulai' => $request->tahun_mulai_pend,
                'tahun_selesai' => $request->tahun_selesai_pend,
                'ipk' => $request->ipk
            ]);
            if (count($request->nama_organisasi) > 0) {
                $userPendOrganisasi = UserPendidikanOrganisasi::where('user_id', auth()->user()->id)->get();
                $userPendOrganisasi->each->delete();

                for ($i = 0; $i < count($request->nama_organisasi); $i++) {
                    $userOrg = new UserPendidikanOrganisasi();
                    $userOrg->user_id = auth()->user()->id;

                    $userOrg->user_pendidikan_id = $userPendidikan->id;
                    $userOrg->nama_organisasi = $request->nama_organisasi[$i];
                    $userOrg->deskripsi = $request->deskripsi_org[$i];
                    $userOrg->tahun_mulai = $request->tahun_mulai_org[$i];
                    $userOrg->tahun_lulus = $request->tahun_lulus_org[$i];

                    if (isset($request->bukti_org[$i])) {
                        $image = $request->file('bukti_org')[$i];
                        $filename = 'bukti_orgs' . uniqid() . strtolower(Str::random(10)) . '.' . $image->extension();
                        $destinationPath = public_path('/storage/bukti_orgs');
                        $fullPath = $destinationPath . '/' . $filename;
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }
                        Image::make($image)->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($fullPath, 85);

                        $userOrg->upload_bukti = $filename;
                    }
                    $userOrg->save();
                }
            }

            if (count($request->nama_prestasi) > 0) {
                $userPendOrganisasi = UserPendidikanPrestasi::where('user_id', auth()->user()->id)->get();
                $userPendOrganisasi->each->delete();

                for ($i = 0; $i < count($request->nama_prestasi); $i++) {
                    $userPrestasi = new UserPendidikanPrestasi();
                    $userPrestasi->user_id = auth()->user()->id;
                    $userPrestasi->user_pendidikan_id = $userPendidikan->id;
                    $userPrestasi->nama_prestasi = $request->nama_prestasi[$i];
                    $userPrestasi->deskripsi = $request->deskripsi_prestasi[$i];
                    $userPrestasi->tahun_prestasi = $request->tahun_prestasi[$i];

                    if (isset($request->bukti_prestasi[$i])) {
                        $image = $request->file('bukti_prestasi')[$i];
                        $filename = 'bukti_prestasis' . uniqid() . strtolower(Str::random(10)) . '.' . $image->extension();
                        $destinationPath = public_path('/storage/bukti_prestasis');
                        $fullPath = $destinationPath . '/' . $filename;
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0755, true);
                        }
                        Image::make($image)->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($fullPath, 85);

                        $userPrestasi->upload_sertifikasi = $filename;
                    }
                    $userPrestasi->save();
                }
            }
            DB::commit();
            return redirect()->route('pengaturan.pendidikan')
                ->with('success', 'Data kontak berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('pengaturan.pendidikan')
                ->withErrors($th->getMessage());
        }
    }
}
