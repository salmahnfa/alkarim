@extends('layouts.dashboard')

@section('content')
        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
                    <div class="page-header">
						<h4 class="page-title">{{ $page_title }}</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">{{ $page_title }}</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Multi Filter Select</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="multi-filter-select" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Tanggal Ujian</th>
													<th>Nama Siswa</th>
													<th>Ujian</th>
													<th>Deskripsi</th>
													<th>Penguji</th>
													<th>Nilai</th>
													<th>Status</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Tanggal Ujian</th>
													<th>Nama Siswa</th>
													<th>Ujian</th>
													<th>Deskripsi</th>
													<th>Penguji</th>
													<th>Nilai</th>
													<th>Status</th>
												</tr>
											</tfoot>
											<tbody>
												@foreach ($nilais as $nilai)
													<tr>
														<td>{{ $nilai->tanggal_ujian }}</td>
														<td>{{ $nilai->siswa->nama }}</td>
														<td>{{ $nilai->ujian->nama }}</td>
														<td>{{ $nilai->deskripsi }}</td>
														<td>{{ $nilai->guruQuran->user->nama }}</td>
														<td>{{ $nilai->nilai }}</td>
														<td>
															@if ($nilai->nilai >= 75)
																Lulus
															@else
																Tidak Lulus
															@endif
														</td>
													</tr>
												@endforeach
												@if (!$nilais->count())
												<tr>
              										<td colspan="9" class="text-center">Belum ada data yang dimasukkan.</td>
           										</tr>
												@endif												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

@section('script')
	<script >
		$(document).ready(function() {
			$('#multi-filter-select').DataTable( {
				"pageLength": 10,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});
		});
	</script>
@endsection