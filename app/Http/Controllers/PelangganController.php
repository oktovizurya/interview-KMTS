<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Pelanggan;
use App\Models\BarangKeluar;
use Auth;

class PelangganController extends Controller
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
        return view('pelanggan.index');
    }
    
    public function data()
    {
        $data = Pelanggan::orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("pelanggan-form", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-pencil icon-sm"></i></a>
                <a href="'.route("pelanggan-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            } else {
                $button = '-';
            }
            return $button;
        })->editColumn('updated_at', function($data)
        {
            $data = date('d M Y - H:i:s', strtotime($data->updated_at));
            return $data;

        })->rawColumns(['action'])->make(true);
    }

    public function form($id = null)
    {
        $data['row'] = Pelanggan::where('id', $id)->first();
        return view('pelanggan.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        if(isset($id)) {
            $post = Pelanggan::find($id);

            $post->nama = $request->nama;
            $post->no_telp = $request->no_telp;
            $post->alamat = $request->alamat;

            $post->save();

            return redirect()->route('pelanggan')->with(['success' => 'Berhasil diupdate']);

        } else {
            $name = Pelanggan::where('no_telp', $request->no_telp)->count();
            if ($name >= 1) {
                return redirect()->route('pelanggan')->with(['error' => 'Data sudah ada']);
            }

            $post = Pelanggan::create([
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);

            return redirect()->route('pelanggan')->with(['success' => 'Berhasil diupload']);

        }
    }

    public function delete($id = null)
    {
        $data = Pelanggan::find($id);
        $cek_barang_keluar = BarangKeluar::where('id_pelanggan', $data->id)->count();
        if ($cek_barang_keluar >= 1) {
            return redirect()->route('pelanggan')->with(['error' => 'Tidak bisa dihapus']);
        }
        $data->delete();
        return redirect()->route('pelanggan')->with(['success' => 'Berhasil dihapus']);
    }
}
