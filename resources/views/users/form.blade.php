@extends('layouts.app')
@php
    if (isset($row)) {
        $role = $row->role;
    } else {
        $role = 0;
    }
    
@endphp
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
            <form class="form" action="{{ route('users-save', isset($row) ? $row->id : '') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama User:</label>
                            <input type="text" value="{{ isset($row) ? $row->name : '' }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus/>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Email:</label>
                            <input type="email" value="{{ isset($row) ? $row->email : '' }}" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email"/>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Role:</label>
                            <select class="form-control" name="role" required>
                                <option>Select</option>
                                <option value="1" {{ $role == 1 ? 'selected' : ''}}>Administrator</option>
                                <option value="2" {{ $role == 1 ? 'selected' : ''}}>Supervisor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Password:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" {{ isset($row) ? '' : 'required' }} autocomplete="new-password"/>
                            <input type="hidden" value="{{ isset($row) ? $row->password : '' }}" name="old_password">
                            <span class="text-danger">* kosongkan jika password tidak diupdate</span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{route('users')}}" class="btn btn-warning">Back</a>
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

