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
									<div class="card-title">Lihat Mutabaah</div>
								</div>
								<div class="card-body">
									<div class="form">
										<div class="form-group form-show-notify row">
											<div class="col-lg-1 col-md-3 col-sm-4 text-right">
												<label>Kelompok</label>
											</div>
											<div class="col-lg-4 col-md-9 col-sm-8">
                                            <select class="form-control input-fixed" id="dropdown-kelompok-halaqah">
                                                @foreach($kelompokHalaqahs as $kelompokHalaqah)
                                                    <option value="{{ $kelompokHalaqah->id }}">{{ $kelompokHalaqah->kelas->nama }} - {{ $kelompokHalaqah->grade }}</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
										<div class="form-group form-show-notify row">
											<div class="col-lg-1 col-md-3 col-sm-4 text-right">
												<label>Tanggal</label>
											</div>
											<div class="col-lg-4 col-md-9 col-sm-8">
                                            <select class="form-control input-fixed" id="dropdown-tanggal">
                                                @foreach($mutabaahs as $mutabaah)
                                                    <option value="{{ $mutabaah->tanggal }}">{{ $mutabaah->tanggal }}</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="form">
										<div class="form-group from-show-notify row">
											<div class="col-lg-4 col-md-9 col-sm-12">
												<button id="displayData" class="btn btn-success">Tampilkan</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Mutabaah Siswa</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="mutabaah-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>#</th>
													<th>Tanggal</th>
													<th>Nama</th>
													<!--<th>Kelas</th>
													<th>Grade</th>-->
													<th>Ziyadah</th>
													<th>Murojaah</th>
													<th>Tilawah</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($mutabaahs as $mutabaah)
												@php
													$ziyadah = json_decode($mutabaah->ziyadah, true);
													$tilawah = json_decode($mutabaah->tilawah, true);
												@endphp
													<tr data-kelompok-halaqah-id="{{ $mutabaah->siswa->kelompok_halaqah_id }}">
														<td>{{ $loop->iteration }}</td>
														<td>{{ $mutabaah->tanggal }}</td>
														<td>{{ $mutabaah->siswa->nama }}</td>
														<!--<td>{{ $mutabaah->siswa->kelas->nama }}</td>
														<td>{{ $mutabaah->siswa->grade }}</td>-->
														<td>{{ \App\Models\Surah::find($ziyadah['surah_mulai_id'])->nama }}:
															{{ $ziyadah['ayat_mulai'] }} –
															{{ \App\Models\Surah::find($ziyadah['surah_selesai_id'])->nama }}:
															{{ $ziyadah['ayat_selesai'] }}
														</td>
														<!--<td>{{ $mutabaah->murojaah }} menit</td>-->
														<td>{{ floor($mutabaah->murojaah / 60) }} jam {{ $mutabaah->murojaah % 60 }} menit</td>
														<td>{{ \App\Models\Surah::find($tilawah['surah_mulai_id'])->nama }}:
															{{ $tilawah['ayat_mulai'] }} –
															{{ \App\Models\Surah::find($tilawah['surah_selesai_id'])->nama }}:
															{{ $tilawah['ayat_selesai'] }}
														</td>
													</tr>
												@endforeach
												@if (!$mutabaahs->count())
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
<script>
	$(document).ready(function() {
		$('#mutabaah-datatables').DataTable({
			"searching": false,
			"pageLength": 10,
		});

		$('#displayData').on('click', function() {
			var kelompokHalaqahId = $('#dropdown-kelompok-halaqah').val();
			var tanggal = $('#dropdown-tanggal').val();

			var tableRows = $('#mutabaah-datatables tbody tr');
			tableRows.hide();
			var filteredRows = tableRows.filter(function() {
				var rowKelompokHalaqahId = $(this).data('kelompok-halaqah-id');
            	var rowTanggal = $(this).find('td:nth-child(2)').text();
				return rowKelompokHalaqahId == kelompokHalaqahId && rowTanggal == tanggal;
			});
			filteredRows.show();
			
			if (filteredRows.length === 0) {
				var noDataRow = $('<tr><td colspan="9" class="text-center">Belum ada data yang dimasukkan.</td></tr>');
				$('#mutabaah-datatables tbody').append(noDataRow);
			} else {
				filteredRows.each(function(index) {
					$(this).find('td:first').text(index + 1);
				});
				$('#mutabaah-datatables tbody tr:last-child').remove();
			}
		});
	});
</script>
@endsection