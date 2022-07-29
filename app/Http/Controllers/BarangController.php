<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Models\Barang;
use App\Models\BarangKeluarDetail;
use App\Models\BarangMasukDetail;

class BarangController extends Controller
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
        return view('barang.index');
    }
    
    public function data()
    {
        $data = Barang::orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("barang_stok-form", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-pencil icon-sm"></i></a>
                <a href="'.route("barang_stok-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            } else {
                $button = '-';
            }
            return $button;
        })->editColumn('updated_at', function($data)
        {
            $data = date('d M Y - H:i:s', strtotime($data->updated_at));
            return $data;

        })->editColumn('harga', function($data)
        {
            $data = "Rp ".number_format($data->harga,2,',','.');
            return $data;

        })->rawColumns(['action', 'harga'])->make(true);
    }

    public function form($id = null)
    {
        $data['row'] = Barang::where('id', $id)->first();
        return view('barang.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        if(isset($id)) {
            $post = Barang::find($id);

            $post->nama_barang = $request->nama_barang;
            $post->harga = $request->harga;
            $post->merk = $request->merk;
            $post->jenis = $request->jenis;

            $post->save();

            return redirect()->route('barang_stok')->with(['success' => 'Berhasil diupdate']);

        } else {
            $name = Barang::where('nama_barang', $request->nama_barang)->where('merk', $request->merk)->count();
            if ($name >= 1) {
                return redirect()->route('barang_stok')->with(['error' => 'Barang dengan nama dan merk ini sudah ada']);
            }

            $post = Barang::create([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'merk' => $request->merk,
                'jenis' => $request->jenis,
            ]);

            return redirect()->route('barang_stok')->with(['success' => 'Berhasil diupload']);

        }
    }

    public function delete($id = null)
    {
        $data = Barang::find($id);
        $cek_barang_keluar = BarangKeluarDetail::where('id_barang', $data->id)->count();
        $cek_barang_masuk = BarangMasukDetail::where('id_barang', $data->id)->count();
        if ($cek_barang_keluar >= 1 || $cek_barang_masuk >= 1) {
            return redirect()->route('barang_stok')->with(['error' => 'Tidak bisa dihapus']);
        }
        $data->delete();
        return redirect()->route('barang_stok')->with(['success' => 'Berhasil dihapus']);
    }
}
