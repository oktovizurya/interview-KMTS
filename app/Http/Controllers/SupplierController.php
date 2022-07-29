<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Auth;

class SupplierController extends Controller
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
        return view('supplier.index');
    }
    
    public function data()
    {
        $data = Supplier::orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("supplier-form", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-pencil icon-sm"></i></a>
                <a href="'.route("supplier-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
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
        $data['row'] = Supplier::where('id', $id)->first();
        return view('supplier.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        if(isset($id)) {
            $post = Supplier::find($id);

            $post->nama = $request->nama;
            $post->no_telp = $request->no_telp;
            $post->alamat = $request->alamat;

            $post->save();

            return redirect()->route('supplier')->with(['success' => 'Berhasil diupdate']);

        } else {
            $name = Supplier::where('no_telp', $request->no_telp)->count();
            if ($name >= 1) {
                return redirect()->route('supplier')->with(['error' => 'Data sudah ada']);
            }

            $post = Supplier::create([
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);

            return redirect()->route('supplier')->with(['success' => 'Berhasil diupload']);

        }
    }

    public function delete($id = null)
    {
        $data = Supplier::find($id);
        $cek_barang_masuk = BarangMasuk::where('id_supplier', $data->id)->count();
        if ($cek_barang_masuk >= 1) {
            return redirect()->route('supplier')->with(['error' => 'Tidak bisa dihapus']);
        }
        $data->delete();
        return redirect()->route('supplier')->with(['success' => 'Berhasil dihapus']);
    }
}
