<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;



class DemoController extends Controller
{
    public function liveSearch(Request $request)
    { 
        $posts = Barang::where('nama_barang','LIKE',"%{$request->search}%")->get();
        return view('livesearchajax')->withPosts($posts);
        
    }
}