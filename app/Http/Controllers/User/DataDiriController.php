<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MasterJabatan;
use App\Models\MasterKeahlian;
use App\Models\User;
use App\Models\UserDataDiri;
use App\Models\UserDataDiriSosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class DataDiriController extends Controller
{
    public function dataDiri()
    {
        $dataDiri = UserDataDiri::with('sosmeds')->where('user_id', auth()->user()->id)->join('users as u', 'u.id', 'user_data_diris.user_id')->first();
        $masterKeahlian = MasterKeahlian::all();
        $masterJabatan = MasterJabatan::all();
        return view('user.pengaturan.datadiri', compact('dataDiri', 'masterKeahlian', 'masterJabatan'));
    }


    public function dataDiriUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama_lengkap' => 'required|max:255',
            'profile_photo' => 'nullable|image',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255',
            'keahlian_id' => 'required|max:255',
            'jabatan_id' => 'required|max:255',
            'alamat_lengkap' => 'required',
            'nomor_telepon' => 'required|max:255',
            'nama_sosial.*' => 'required',
            'url_sosial.*' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengaturan.data.diri')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            DB::beginTransaction();
            $user = User::find(auth()->user()->id);

            $user->update([
                'name' => $request->input('nama_lengkap'),
                'email' => $request->input('email')
            ]);

            $dataDiri = UserDataDiri::where('user_id', auth()->user()->id)->first();

            $dataDiri->tempat_lahir = $request->input('tempat_lahir');
            $dataDiri->tanggal_lahir = $request->input('tanggal_lahir');
            $dataDiri->tanggal_lahir = $request->input('tanggal_lahir');
            $dataDiri->keahlian_id = $request->input('keahlian_id');
            $dataDiri->jabatan_id = $request->input('jabatan_id');
            $dataDiri->alamat_lengkap = $request->input('alamat_lengkap');
            $dataDiri->nomor_telepon = $request->input('nomor_telepon');

            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $filename = 'profile_photos' . uniqid() . strtolower(Str::random(10)) . '.' . $request->profile_photo->extension();
                $destinationPath = public_path('/storage/profile_photos');
                $fullPath = $destinationPath . '/' . $filename;
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                Image::make($image)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($fullPath, 85);

                $dataDiri->profile_photo = $filename;
            }

            $dataDiri->save();

            $sosmed = UserDataDiriSosmed::where('user_id', auth()->user()->id)->get();
            if (isset($sosmed)) {
                $sosmed->each->delete();
            }

            $nama_sosmed = $request->nama_sosial;
            $url_sosmed = $request->url_sosial;
            for ($i = 0; $i < count($request->url_sosial); $i++) {
                UserDataDiriSosmed::create([
                    'user_id' =>  auth()->user()->id,
                    'user_data_diri_id' =>  $dataDiri->id,
                    'nama_sosmed' =>  $nama_sosmed[$i],
                    'url_sosmed' =>  $url_sosmed[$i]
                ]);
            }

            DB::commit();
            return redirect()->route('pengaturan.data.diri')
                ->with('success', 'Data diri berhasil diupdate.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('pengaturan.data.diri')
                ->withErrors($th->getMessage());
        }
    }
}
