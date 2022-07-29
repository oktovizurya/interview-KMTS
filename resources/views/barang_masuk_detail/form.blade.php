@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-account"></i>
        </span> Barang Masuk Detail 
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
            <h4 class="card-title">Form Barang Masuk </h4>
            <!--begin::Form-->
            <form class="form" action="{{ route('barang_masuk_detail-save', isset($id) ? $id : '') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Barang:</label>
                            <select class="form-control select2" id="" name="id_barang" required>
                                <option selected>Select</option>
                                @foreach ($barang as $item)
                                <option value="{{ $item->id }}"}>{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Jumlah:</label>
                            <input type="number" min="1" value="" class="form-control" name="jumlah" required/>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{route('barang_masuk_detail', isset($id) ? $id : '')}}" class="btn btn-warning">Back</a>
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
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection

