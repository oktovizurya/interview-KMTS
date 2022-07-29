<html>
<head>
	<title>Laporan Barang Masuk</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
			width: auto;
			margin: auto;
		}
	</style>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Supplier</th>
				<th>Barang</th>
				<th>Tanggal</th>
				<th>Total Harga</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1; $total=0; @endphp
			@foreach($barang_masuk as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $p->supplier->nama }}</td>
				<td>
					<table class="table table-bordered">
						<tr>
							<th>Nama</th>
							<th>Jumlah</th>
							<th>Total</th>
						</tr>
						@foreach ($p->barang_masuk_detail as $item)
						<tr>
								<td>{{ $item->barang->nama_barang }}</td>
								<td>{{ $item->jumlah }}</td>
								<td>Rp {{ number_format($item->total,2,',','.') }}</td>
						</tr>
						@endforeach
					</table>
				</td>
				<td>{{date('d M Y', strtotime($p->tanggal))}}</td>
				<td>Rp {{ number_format($p->total_harga,2,',','.') }}</td>
			</tr>
			@php
				$total += $p->total_harga; 
			@endphp
			@endforeach
			<tr>
				<td colspan="4">Total</td>
				<td>Rp {{ number_format($total,2,',','.') }}</td>
			</tr>
		</tbody>
	</table>
 
</body>
<script>
	
</script>
</html>