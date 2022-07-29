@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span> Pelanggan 
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
            <h4 class="card-title">Form Pelanggan</h4>
            <!--begin::Form-->
            <form class="form" action="{{ route('pelanggan-save', isset($row) ? $row->id : '') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama:</label>
                            <input type="text" value="{{ isset($row) ? $row->nama : '' }}" class="form-control" name="nama" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Telp:</label>
                            <input type="number" maxlength="12" value="{{ isset($row) ? $row->no_telp : '' }}" class="form-control" name="no_telp" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Alamat:</label>
                            <input type="text" value="{{ isset($row) ? $row->alamat : '' }}" class="form-control" name="alamat" required/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{route('pelanggan')}}" class="btn btn-warning">Back</a>
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

