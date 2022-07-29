<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\BarangKeluarDetail;
use App\Models\BarangKeluar;
use App\Models\Pelanggan;
use App\Models\Barang;
use Auth;

class BarangKeluarDetailController extends Controller
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
    public function index($id = null)
    {
        $data['id'] = $id;
        return view('barang_keluar_detail.index', $data);
    }
    
    public function data($id = null)
    {
        $data = BarangKeluarDetail::where('id_barang_keluar', $id)->orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("barang_keluar_detail-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            } else {
                $button = '-';
            }
            return $button;
        })->editColumn('updated_at', function($data)
        {
            $data = date('d M Y - H:i:s', strtotime($data->updated_at));
            return $data;

        })->editColumn('total', function($data)
        {
            $data = "Rp ".number_format($data->total,2,',','.');
            return $data;

        })->editColumn('id_barang', function($data)
        {
            $data = $data->barang->nama_barang ?? '';
            return $data;

        })->rawColumns(['action', 'total'])->make(true);
    }

    public function form($id = null)
    {
        $data['id'] = $id;
        $data['barang'] = Barang::get();
        return view('barang_keluar_detail.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        $barang_keluar = BarangKeluar::find($id);
        $barang = Barang::find($request->id_barang);
        if ($barang->stok >= $request->jumlah) {

            $post = BarangKeluarDetail::create([
                'id_barang_keluar' => $id,
                'id_barang' => $request->id_barang,
                'jumlah' => $request->jumlah,
                'total' => $barang->harga * $request->jumlah,
            ]);

            $barang->stok = $barang->stok - $request->jumlah;
            $barang->update();

            $barang_keluar->total_harga = $barang_keluar->total_harga + ($barang->harga * $request->jumlah);
            $barang_keluar->update();

        } else {
            return redirect()->route('barang_keluar_detail', $id)->with(['error' => 'Stok tidak cukup']);
        }

        return redirect()->route('barang_keluar_detail', $id)->with(['success' => 'Berhasil diupload']);
    }

    public function delete($id = null)
    {
        $data = BarangKeluarDetail::find($id);
        $barang_keluar = BarangKeluar::find($data->id_barang_keluar);
        $barang = Barang::where('id', $data->id_barang)->first();

        $barang->stok = $barang->stok + $data->jumlah;
        $barang->update();

        $barang_keluar->total_harga = $barang_keluar->total_harga - $data->total;
        $barang_keluar->update();

        $data->delete();
        return redirect()->route('barang_keluar_detail', $data->id_barang_keluar)->with(['success' => 'Berhasil dihapus']);
    }
}
