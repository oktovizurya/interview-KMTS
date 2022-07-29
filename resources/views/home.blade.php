@extends('layouts.app')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard 
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Barang<i class="mdi mdi-archive mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ App\Models\Barang::count() ?? '0' }} Item</h2>
                <a href="/barang_stok" class="text-white" style="text-decoration: none"><h6 class="card-text">Lihat</h6></a>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Supplier <i class="mdi mdi-account mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ App\Models\Supplier::count() ?? '0' }} Orang</h2>
                <a href="/supplier" class="text-white" style="text-decoration: none"><h6 class="card-text">Lihat</h6></a>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Pelanggan <i class="mdi mdi-account mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{ App\Models\Pelanggan::count() ?? '0' }} Orang</h2>
                <a href="/pelanggan" class="text-white" style="text-decoration: none"><h6 class="card-text">Lihat</h6></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="search">
                    <h3 class="text-center title-color">Search Data Barang</h3>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="input-group">
                                <input type="text" autocomplete="off" id="search" class="form-control input-lg" placeholder="Search Barang">
                            </div>
                        </div>
                    </div>   
                </div>  
                <!-- search box container ends  -->
                <div id="txtHint" class="title-color" style="padding-top:50px; text-align:center;" >
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                </tr>
                            
                           
                                @php
                                    $count=1;
                                @endphp
                                @foreach ($barang as $item)
                                <tr> 
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->harga }}</td>
                                </tr> 
                                @endforeach
                                
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
    
        <div class="card">
            <div class="card-header">
                <form action="" method="post" >
                    @csrf
                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <input type="date" name="tanggal1" class="form-control form-control-sm ">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="tanggal2" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" value="filter" class="btn btn-sm btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <canvas id="canvas" height="300px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Barang Keluar</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Nama Barang </th>
                                <th> Jumlah </th>
                                <th> Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang_keluar_detail as $item)
                            <tr>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->total,2,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var str=  $("#search").val();
            if(str == "") {
                $( "#txtHint" ).html("<b>List barang....</b>"); 
            }else {
                $.get( "{{ url('demos/livesearch?search=') }}"+str, function( data ) {
                    $( "#txtHint" ).html( data );  
                });
            }
        });  
    }); 
    var year = <?php echo $tanggal; ?>;
    var user = <?php echo $total; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Penjualan',
            backgroundColor: "pink",
            data: user,
            minBarLength: 0
        }]
    };
    
    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Total Penjualan per Hari'
                }
            }
        });
    };
</script>
@endsection