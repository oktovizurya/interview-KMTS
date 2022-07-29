<html>
<head>
	<title>Laporan Barang Keluar</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($barang_keluar_detail as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->barang->nama_barang}}</td>
				<td>{{$p->jumlah}}</td>
				<td>Rp {{ number_format($p->total,2,',','.') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>