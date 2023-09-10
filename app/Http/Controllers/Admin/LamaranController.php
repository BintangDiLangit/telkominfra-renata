<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\MasterMilestone;
use App\Models\MilestoneLamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LamaranController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:view_lamarans'])->only('index');
        $this->middleware(['permission:add_lamarans'])->only('store');
        $this->middleware(['permission:edit_lamarans'])->only('update');
        $this->middleware(['permission:delete_lamarans'])->only('destroy');
    }
    public function index()
    {
        $lowongans = Lowongan::all();
        return view('admin.lamaran.index', compact('lowongans'));
    }

    public function searchLowongan(Request $request)
    {
        $keyword = $request->get('q');
        $lowongans = Lowongan::with('kategoriLowongan', 'company')
            ->where('judul', 'LIKE', "%{$keyword}%")
            ->orwhere('id', '=', "%{$keyword}%")
            ->orWhereHas('kategoriLowongan', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%");
            })->get();

        return response()->json($lowongans);
    }

    public function milestoneLamaran($lowongan_id)
    {

        $lowongan = Lowongan::find($lowongan_id);
        $milestoneLamarans = MasterMilestone::with(['lamarans' => function ($query) use ($lowongan_id) {
            $query->where('lowongan_id', $lowongan_id)->with('lowongan');
        }])->orderBy('urutan', 'asc')->get();

        return view('admin.lamaran.show', compact('milestoneLamarans', 'lowongan'));
    }

    public function milestoneLamaranDetail($lowongan_id, $milestone_id)
    {
        if ($lowongan_id == 0) {
            return redirect()->back()
                ->withErrors(['Not Found' => 'Tidak Ada Lamaran Untuk Lowongan Tersebut']);
        }
        $milestone = MasterMilestone::find($milestone_id);
        $lowongan = Lowongan::find($lowongan_id);
        $lamarans = Lamaran::where([['lowongan_id', $lowongan_id], ['milestone_id', $milestone_id]])->orderBy('created_at', 'desc')->get();
        return view('admin.lamaran.lamaran_detail_milestone', compact('lamarans', 'milestone', 'lowongan'));
    }

    public function milestoneLamaranDetailPelamar($lamaran_id)
    {
        $lamaran = Lamaran::find($lamaran_id);
        $milestone = MasterMilestone::find($lamaran->milestone_id);
        $nextMilestone = MasterMilestone::where('urutan', $milestone->urutan + 1)->first();

        if ($lamaran_id == 0 || !isset($lamaran)) {
            return redirect()->back()
                ->withErrors(['Not Found' => 'Data Tidak Ditemukan']);
        }
        return view('admin.lamaran.detail_pelamar', compact('lamaran', 'nextMilestone'));
    }

    public function approve(Request $request, $lamaran_id)
    {
        $lamaran = Lamaran::find($lamaran_id);
        $milestone = MasterMilestone::find($lamaran->milestone_id);
        $nextMilestone = MasterMilestone::where('urutan', $milestone->urutan + 1)->first();

        if ($lamaran_id == 0 || !isset($lamaran)) {
            return redirect()->back()
                ->withErrors(['Not Found' => 'Data Tidak Ditemukan']);
        }
        try {
            DB::beginTransaction();
            $lamaran->status = "PASSED";
            $lamaran->milestone_id = $nextMilestone->id;
            $lamaran->save();
            MilestoneLamaran::create([
                'lamaran_id' => $lamaran->id,
                'milestone_id' => $nextMilestone->id,
                'remark' => json_encode($request->all())
            ]);
            DB::commit();
            return redirect()->route('admin.lamaran.milestone.lamaran.detail', ['lowongan_id' => $lamaran->lowongan_id, 'milestone_id' => $lamaran->milestone_id]);
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors($th->getMessage());
        }
    }
    public function reject($lamaran_id)
    {
        $lamaran = Lamaran::find($lamaran_id);
        $milestone = MasterMilestone::find($lamaran->milestone_id);
        $nextMilestone = MasterMilestone::where('urutan', $milestone->urutan + 1)->first();

        if ($lamaran_id == 0 || !isset($lamaran)) {
            return redirect()->back()
                ->withErrors(['Not Found' => 'Data Tidak Ditemukan']);
        }
        return view('admin.lamaran.detail_pelamar', compact('lamaran', 'nextMilestone'));
    }
}