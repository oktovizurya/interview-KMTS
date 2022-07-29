<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\Barang;
use App\Models\Supplier;
use PDF;
use Auth;

class BarangMasukController extends Controller
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
        return view('barang_masuk.index');
    }
    
    public function data()
    {
        $data = BarangMasuk::orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("barang_masuk-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
                <a href="'.route("barang_masuk_detail", $data->id).'" style="text-decoration: none"><i class="text-primary mdi mdi-format-list-numbered icon-sm"></i></a>
                <a target="_blank" href="'.route("barang_masuk-print", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-printer icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            } else {
                $button = '<a href="'.route("barang_masuk_detail", $data->id).'" style="text-decoration: none"><i class="text-primary mdi mdi-format-list-numbered icon-sm"></i></a>
                <a target="_blank" href="'.route("barang_masuk-print", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-printer icon-sm"></i></a>
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

        })->editColumn('id_supplier', function($data)
        {
            $data = $data->supplier->nama ?? '';
            return $data;

        })->rawColumns(['action', 'harga'])->make(true);
    }

    public function form($id = null)
    {
        $data['row'] = BarangMasuk::where('id', $id)->first();
        $data['supplier'] = Supplier::get();
        return view('barang_masuk.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        if(isset($id)) {
            $post = BarangMasuk::find($id);

            $post->id_supplier = $request->id_supplier;
            $post->tanggal = $request->tanggal;

            $post->save();

            return redirect()->route('barang_masuk')->with(['success' => 'Berhasil diupdate']);

        } else {

            $post = BarangMasuk::create([
                'id_supplier' => $request->id_supplier,
                'tanggal' => $request->tanggal,
            ]);

            return redirect()->route('barang_masuk')->with(['success' => 'Berhasil diupload']);

        }
    }

    public function delete($id = null)
    {
        $data = BarangMasuk::find($id);

        $data_detail = BarangMasukDetail::where('id_barang_masuk', $id)->get();

        foreach ($data_detail as $value) {
            
            $barang_masuk_detail = BarangMasukDetail::find($value->id);
            
            $post = Barang::find($value->id_barang);

            $post->stok = $post->stok - $value->jumlah;

            $post->update();

            $barang_masuk_detail->delete();
        }
        $data->delete();

        return redirect()->route('barang_masuk')->with(['success' => 'Berhasil dihapus']);
    }

    public function print($id = null)
    {
        $data = BarangMasukDetail::where('id_barang_masuk', $id)->get();
        
        $pdf = PDF::loadview('barang_masuk.print', ['barang_masuk_detail' => $data]);
        return $pdf->stream();
    }

    public function print_date(Request $request)
    {
        $data = BarangMasuk::whereBetween('tanggal', [$request->tanggal_dari, $request->tanggal_sampai])
        ->get();

        // return view('barang_masuk.print_date', ['barang_masuk' => $data]);
        
        $pdf = PDF::loadview('barang_masuk.print_date', ['barang_masuk' => $data]);
        return $pdf->stream();
    }
}
