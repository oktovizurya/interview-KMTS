<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Auth;

class UserAccountController extends Controller
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
        return view('users.index');
    }
    
    public function data()
    {
        $data = User::orderBy('id', 'DESC')->get();
        return Datatables::of($data)->addIndexColumn()->addColumn('action', function($data){
            if (Auth::user()->role == 1) {
                $button = '<a href="'.route("users-form", $data->id).'" style="text-decoration: none"><i class="text-info mdi mdi-pencil icon-sm"></i></a>
                <a href="'.route("users-delete", $data->id).'" style="text-decoration: none" class="delete"><i class="text-danger mdi mdi-delete icon-sm"></i></a>
                <script src="assets/js/alert.js"></script>';
            } else {
                $button = '-';
            }
            return $button;
        })->editColumn('updated_at', function($data)
        {
            $data = date('d M Y - H:i:s', strtotime($data->updated_at));
            return $data;

        })->editColumn('role', function($data)
        {
            if ($data->role == 1) {
                $role = 'Administrator';
            } else {
                $role = 'Supervisor';
            }
            return $role;

        })->rawColumns(['action'])->make(true);
    }

    public function form($id = null)
    {
        $data['row'] = User::where('id', $id)->first();
        return view('users.form', $data);
    }

    public function save(Request $request, $id = null)
    {
        if(isset($id)) {
            $post = User::find($id);

            if (isset($request->password)) {
                $password = Hash::make($request->password);
            } else {
                $password = $request->old_password;
            }

            $post->name = $request->name;
            $post->email = $request->email;
            $post->role = $request->role;
            $post->password = $password;

            $post->save();

            return redirect()->route('users')->with(['success' => 'Berhasil diupdate']);

        } else {
            $post = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('users')->with(['success' => 'Berhasil diupload']);

        }
    }

    public function delete($id = null)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('users')->with(['success' => 'Berhasil dihapus']);
    }
}
