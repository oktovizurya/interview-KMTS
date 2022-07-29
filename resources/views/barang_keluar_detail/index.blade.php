@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span> Barang Keluar Detail 
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb">
                <a href="/barang_keluar" class="btn btn-warning btn-sm"><i class="mdi mdi-keyboard-backspace"></i> Back</a>
            </li>
            @if (Auth::user()->role == 1)
            <li class="breadcrumb">
                <a href="/barang_keluar_detail/form/{{ $id }}" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Tambah</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Barang Keluar Detail</h4>@if (session('error'))
            <div class="alert alert-danger"><i class="flaticon-exclamation text-danger"></i> {{ session('error') }}</div>
            @elseif (session('success'))
            <div class="alert alert-success"><i class="flaticon-exclamation text-success"></i> {{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    jQuery(function ($) {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/barang_keluar_detail/data/{{ $id }}',
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'id_barang', name: 'id_barang' },
            { data: 'jumlah', name: 'jumlah' },
            { data: 'total', name: 'total' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false }
            ]
        });
    });
    
</script> 
@endsection

