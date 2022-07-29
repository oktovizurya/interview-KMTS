<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\BarangMasukDetail;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Models\Barang;
use Auth;

class BarangMasukDetailController extends Controller
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
        return view('barang_masuk_detail.index', $data);
    }
    
    public function data($id = null)
    {
        $data = BarangMasukDetail::where('id_barang_masuk', $id)->orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("barang_masuk_detail-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
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
        return view('barang_masuk_detail.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        $barang_masuk = BarangMasuk::find($id);
        $barang = Barang::find($request->id_barang);
        $post = BarangMasukDetail::create([
            'id_barang_masuk' => $id,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'total' => $barang->harga * $request->jumlah,
        ]);

        $barang->stok = $barang->stok + $request->jumlah;
        $barang->update();

        $barang_masuk->total_harga = $barang_masuk->total_harga + ($barang->harga * $request->jumlah);
        $barang_masuk->update();

        return redirect()->route('barang_masuk_detail', $id)->with(['success' => 'Berhasil diupload']);
    }

    public function delete($id = null)
    {
        $data = BarangMasukDetail::find($id);
        $barang_masuk = BarangMasuk::find($data->id_barang_masuk);
        $barang = Barang::where('id', $data->id_barang)->first();

        $barang->stok = $barang->stok + $data->jumlah;
        $barang->update();

        $barang_masuk->total_harga = $barang_masuk->total_harga - $data->total;
        $barang_masuk->update();

        $data->delete();
        return redirect()->route('barang_masuk_detail', $data->id_barang_masuk)->with(['success' => 'Berhasil dihapus']);
    }
}
