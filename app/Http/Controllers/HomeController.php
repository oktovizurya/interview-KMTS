<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasukDetail;
use App\Models\BarangKeluarDetail;
use App\Models\BarangKeluar;
use App\Models\Pelanggan;
use App\Models\Supplier;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request['tanggal1'])) {
            $query = BarangKeluar::select('tanggal', DB::raw("(SUM(total_harga)) as total"))->groupBy('tanggal')->whereBetween('tanggal',[$request['tanggal1'],$request['tanggal2']])->get();
        }else {
            $query = BarangKeluar::select('tanggal', DB::raw("(SUM(total_harga)) as total"))->groupBy('tanggal')->get();
        }
        
        //$query = BarangKeluar::select('tanggal', DB::raw("(SUM(total_harga)) as total"))->groupBy('tanggal')->get();
        $total = [];
        $tanggal = [];
        foreach ($query as $value) {
            $tanggal[] = $value['tanggal'];
            $total[] = $value['total'];
        }
        $data['barang_masuk_detail'] = BarangMasukDetail::orderBy('id', 'DESC')->limit(10)->get();
        $data['barang_keluar_detail'] = BarangKeluarDetail::orderBy('id', 'DESC')->limit(10)->get();
        $data['barang'] = Barang::orderBy('id', 'DESC')->limit(10)->get();
        $data['tanggal'] = json_encode($tanggal);
        $data['total'] = json_encode($total);
        //dd($data['total']);
        return view('home', $data);
    }
}
