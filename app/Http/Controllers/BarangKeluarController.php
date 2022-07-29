<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use App\Models\Barang;
use App\Models\Pelanggan;
use Auth;

class BarangKeluarController extends Controller
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
    public function index()
    {
        return view('barang_keluar.index');
    }
    
    public function data()
    {
        $data = BarangKeluar::orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("barang_keluar-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
                <a href="'.route("barang_keluar_detail", $data->id).'" style="text-decoration: none"><i class="text-primary mdi mdi-format-list-numbered icon-sm"></i></a>
                <a target="_blank" href="'.route("barang_keluar-print", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-printer icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            } else {
                $button = '<a href="'.route("barang_keluar_detail", $data->id).'" style="text-decoration: none"><i class="text-primary mdi mdi-format-list-numbered icon-sm"></i></a>
                <a target="_blank" href="'.route("barang_keluar-print", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-printer icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            }
            return $button;
        })->editColumn('updated_at', function($data)
        {
            $data = date('d M Y - H:i:s', strtotime($data->updated_at));
            return $data;

        })->editColumn('tanggal', function($data)
        {
            $data = date('d M Y', strtotime($data->tanggal));
            return $data;

        })->editColumn('total_harga', function($data)
        {
            $data = "Rp ".number_format($data->total_harga,2,',','.');
            return $data;

        })->editColumn('id_pelanggan', function($data)
        {
            $data = $data->pelanggan->nama ?? '';
            return $data;

        })->rawColumns(['action', 'harga'])->make(true);
    }

    public function form($id = null)
    {
        $data['row'] = BarangKeluar::where('id', $id)->first();
        $data['pelanggan'] = Pelanggan::get();
        return view('barang_keluar.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        if(isset($id)) {
            $post = BarangKeluar::find($id);

            $post->id_pelanggan = $request->id_pelanggan;
            $post->tanggal = $request->tanggal;

            $post->save();

            return redirect()->route('barang_keluar')->with(['success' => 'Berhasil diupdate']);

        } else {

            $post = BarangKeluar::create([
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal' => $request->tanggal,
            ]);

            return redirect()->route('barang_keluar')->with(['success' => 'Berhasil diupload']);

        }
    }

    public function delete($id = null)
    {
        $data = BarangKeluar::find($id);

        $data_detail = BarangKeluarDetail::where('id_barang_keluar', $id)->get();

        foreach ($data_detail as $value) {
            
            $barang_keluar_detail = BarangKeluarDetail::find($value->id);
            
            $post = Barang::find($value->id_barang);

            $post->stok = $post->stok + $value->jumlah;

            $post->update();

            $barang_keluar_detail->delete();
        }
        $data->delete();

        return redirect()->route('barang_keluar')->with(['success' => 'Berhasil dihapus']);
    }

    public function print($id = null)
    {
        $data = BarangKeluarDetail::where('id_barang_keluar', $id)->get();
        
        $pdf = PDF::loadview('barang_keluar.print', ['barang_keluar_detail' => $data]);
        return $pdf->stream();
    }

    public function print_date(Request $request)
    {
        $data = BarangKeluar::whereBetween('tanggal', [$request->tanggal_dari, $request->tanggal_sampai])
        ->get();

        // return view('barang_keluar.print_date', ['barang_keluar' => $data]);
        
        $pdf = PDF::loadview('barang_keluar.print_date', ['barang_keluar' => $data]);
        return $pdf->stream();
    }
}
