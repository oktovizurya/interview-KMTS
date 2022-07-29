@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span> Barang Masuk  
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <form action="{{ route('barang_masuk-print_date') }}" method="POST" target="_blank">
                @csrf
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="date" name="tanggal_dari" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="tanggal_sampai" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-info btn-sm text-white"><i class="mdi mdi-printer"></i></button>
                    </div>
                    @if (Auth::user()->role == 1)
                    <div class="col-md-3">
                        <a href="/barang_masuk/form" class="btn btn-success btn-sm"><i class="mdi mdi-plus"></i> Tambah</a>
                    </div>
                    @endif
                </div>
            </form>
        </ul>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Barang Masuk</h4>@if (session('error'))
            <div class="alert alert-danger"><i class="flaticon-exclamation text-danger"></i> {{ session('error') }}</div>
            @elseif (session('success'))
            <div class="alert alert-success"><i class="flaticon-exclamation text-success"></i> {{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Supplier</th>
                            <th>Total Dibayarkan</th>
                            <th>Tanggal</th>
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
            ajax: '/barang_masuk/data',
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'id_supplier', name: 'id_supplier' },
            { data: 'total_harga', name: 'total_harga' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false }
            ]
        });
    });
    
</script> 
@endsection

