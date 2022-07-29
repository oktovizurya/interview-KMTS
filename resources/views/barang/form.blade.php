@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span> Barang 
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Form Barang</h4>
            <!--begin::Form-->
            <form class="form" action="{{ route('barang_stok-save', isset($row) ? $row->id : '') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama Barang:</label>
                            <input type="text" value="{{ isset($row) ? $row->nama_barang : '' }}" class="form-control" name="nama_barang" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Harga:</label>
                            <input type="number" min="1000" value="{{ isset($row) ? $row->harga : '' }}" class="form-control" name="harga" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Merk:</label>
                            <input type="text" value="{{ isset($row) ? $row->merk : '' }}" class="form-control" name="merk" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Jenis:</label>
                            <input type="text" value="{{ isset($row) ? $row->jenis : '' }}" class="form-control" name="jenis" required/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{route('barang_stok')}}" class="btn btn-warning">Back</a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                     </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection

