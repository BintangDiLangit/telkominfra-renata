<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\KategoriLowongan;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\MasterMilestone;
use App\Models\MilestoneLamaran;
use App\Models\RiwayatPekerjaan;
use App\Models\UserLowonganFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $kategoriLowongans = KategoriLowongan::limit(5)->get();
        $lowongans = Lowongan::limit(4)->get();
        return view('user.main', compact('kategoriLowongans', 'lowongans'));
    }

    public function searchLowongan(Request $request)
    {
        $keyword = $request->keyword;
        $kategoriLowongans = KategoriLowongan::limit(5)->get();
        $lowongans = Lowongan::with('kategoriLowongan', 'company')
            ->where('judul', 'LIKE', "%{$keyword}%")
            ->orwhere('id', 'LIKE', "%{$keyword}%")
            ->orWhereHas('kategoriLowongan', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })->get();
        return view('user.search-lowongan', compact('kategoriLowongans', 'lowongans'));
    }

    public function getLowonganDetail($id)
    {
        $user_id = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        $has_applied = Lamaran::where('user_id', $user_id)->where('lowongan_id', $id)->exists();

        $lowongan = Lowongan::with('company')->find($id);

        // Menambahkan informasi apakah pengguna telah melamar ke dalam array respons
        $lowongan['has_applied'] = $has_applied;

        return response()->json($lowongan);
    }

    public function checkData()
    {
        $user = auth()->user();

        // Contoh sederhana, Anda dapat menyesuaikan logika ini sesuai kebutuhan Anda
        $riwayatPekerjaan = RiwayatPekerjaan::where('user_id', $user->id)->first();
        $dokumen = Dokumen::where('user_id', $user->id)->first();
        $isCompletePribadi = $user->name && $user->email;
        $isCompleteRiwayatPekerjaan = isset($riwayatPekerjaan);
        $isCompleteDokumen = isset($dokumen) && $dokumen->cv && $dokumen->ijazah && $dokumen->transkrip;

        $isComplete = $isCompletePribadi && $isCompleteDokumen;

        return response()->json(['isComplete' => $isComplete]);
    }

    public function lamaranStore(Request $request)
    {
        $data = $request->validate([
            'lowongan_id' => 'required|exists:lowongans,id',
            'ekspektasi_gaji' => 'required',
            'tanggal_kesiapan_bergabung' => 'required',
            'benefit' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $user = auth()->user();
            $data = [
                'user_id' => $user->id,

                'lowongan_id' => $request->lowongan_id,
                'ekspektasi_gaji' => $request->ekspektasi_gaji,
                'tanggal_kesiapan_bergabung' => $request->tanggal_kesiapan_bergabung,
                'benefit' => $request->benefit,

                'profile_photo' => $user->dataDiri->profile_photo,
                'tempat_lahir' => $user->dataDiri->tempat_lahir,
                'tanggal_lahir' => $user->dataDiri->tanggal_lahir,
                'keahlian_id' => $user->dataDiri->keahlian_id,
                'jabatan_id' => $user->dataDiri->jabatan_id,
                'alamat_lengkap' => $user->dataDiri->alamat_lengkap,
                'nomor_telepon' => $user->dataDiri->nomor_telepon,
                'sosmeds' => $user->dataDiri->sosmeds,

                'keluargas' => $user->keluargas,
                'kontak_darurats' => $user->kontakDarurats,
                'pendidikans' => $user->pendidikans,
                'pendidikan_organisasis' => $user->pendidikanOrganisasis,
                'pendidikan_prestasis' => $user->pendidikanPrestasis,
                'riwayat_pekerjaans' => $user->riwayatPekerjaans,
                'dokumens' => $user->dokumens,
            ];

            $lamaran = Lamaran::create($data);

            MilestoneLamaran::create([
                'lamaran_id' => $lamaran->id,
                'milestone_id' => 1
            ]);

            DB::commit();

            return response()->json(['message' => 'Lamaran berhasil dikirim!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['errors' => $th->getMessage()]);
        }
    }


    public function lamaranSaya()
    {
        $masterMilestone = MasterMilestone::orderBy('urutan', 'asc')->get();
        $lamaranSaya = Lamaran::with('lowongan', 'milestone', 'keahlian', 'milestoneLamaran.milestone')->where('user_id', auth()->user()->id)->get();
        return view('user.lamaran', compact('lamaranSaya', 'masterMilestone'));
    }
    public function elearning()
    {
        return view('user.elearning');
    }
    public function lamaranFavorit()
    {
        // $lowongan = UserLowonganFavorit::where('user_id', auth()->user()->id)->where('lowongan_id', $lowongan_id)->first();
        return view('user.lowongan-favorit');
    }

    public function lowonganFavoritStatus($lowongan_id)
    {
        $lowongan = UserLowonganFavorit::where('user_id', auth()->user()->id)->where('lowongan_id', $lowongan_id)->first();
        if (isset($lowongan)) {
            $lowongan->delete();
        } else {
            $lowongan->user_id =  auth()->user()->id;
            $lowongan->lowongan_id =  $lowongan_id;
            $lowongan->save();
        }
        return redirect()->back()
            ->with('success', 'Status lowongan favorit berhasil diupdate');
    }
}