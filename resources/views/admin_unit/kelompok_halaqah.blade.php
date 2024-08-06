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
									<div class="card-title">Cari Kelompok Halaqah</div>
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
                    <div class="row" id="kelompok-halaqah-column" style="display: none;">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Nama</h4>
									<!--<div class="card-category">Pengampu: </a></div>-->
								</div>
								<div class="card-body">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td style="width: 20%; vertical-align: middle;">Guru Pengampu</td>
												<td id="guru-quran-nama"> </td>
											</tr>
											<tr>
												<td style="width: 20%; vertical-align: middle;">Kelas</td>
												<td id="kelas-info"> </td>
											</tr>
											<tr>
												<td style="width: 20%; vertical-align: middle;">Grade</td>
												<td id="grade-info"> </td>
											</tr>
										</tbody>
									</table>
									<div class="table-responsive">
										<table id="kelompok-halaqah-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>NISN</th>
													<th>Nama</th>
													<th>Surah Dihafal</th>
													<th>Jilid</th>
												</tr>
											</thead>
											<tbody>
												@foreach($siswas as $siswa)
													<tr data-kelompok-halaqah-id="{{ $siswa->kelompok_halaqah_id }}">
														<td>{{ $loop->iteration }}</td>
														<td>{{ $siswa->nisn }}</td>
														<td>{{ $siswa->nama }}</td>
														<td>{{ $siswa->surah->nama }}</td>
														<td>{{ $siswa->jilid->nama }}</td>
													</tr>
												@endforeach
												@if (!$siswas->count())
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
		var siswas = {!! json_encode($siswas) !!};

		$('#kelompok-halaqah-datatables').DataTable({
			"paging": false,
			"searching": false,
		});

		$('#displayData').on('click', function() {
			var kelompokHalaqahId = $('#dropdown-kelompok-halaqah').val();
			var filteredRows = siswas.filter(function(siswa) {
				return siswa.kelompok_halaqah_id == kelompokHalaqahId;
			});

			var tbody = $('#kelompok-halaqah-datatables tbody');
			tbody.empty();

			if (filteredRows.length > 0) {
				filteredRows.forEach(function(siswa, index) {
					var row = $('<tr>');
					row.append('<td>' + (index + 1) + '</td>');
					row.append('<td>' + siswa.nisn + '</td>');
					row.append('<td>' + siswa.nama + '</td>');
					row.append('<td>' + siswa.surah.nama + '</td>');
					row.append('<td>' + siswa.jilid.nama + '</td>');
					tbody.append(row);
				});
			} else {
				var noDataRow = $('<tr><td colspan="9" class="text-center">Belum ada data yang dimasukkan.</td></tr>');
				tbody.append(noDataRow);
			}

			var kelompokHalaqahs = {!! json_encode($kelompokHalaqahs) !!};
			var selectedKelompokHalaqah = kelompokHalaqahs.filter(function(kelompokHalaqah) {
				return kelompokHalaqah.id == kelompokHalaqahId;
			})[0];

			var guruQuranId = selectedKelompokHalaqah.guru_quran_id;
			var guruQurans = {!! json_encode($guruQurans) !!}.filter(function(guruQuran) {
				return guruQuran.id == guruQuranId;
			})[0];

			var userId = guruQurans.user_id;
			var users = {!! json_encode($users) !!}.filter(function(user) {
				return user.id == userId;
			})[0].nama;

			var kelompokHalaqahNama = $('#kelompok-halaqah-column .card-title');
			kelompokHalaqahNama.text('Kelompok ' + selectedKelompokHalaqah.kelas.nama + ' - ' + selectedKelompokHalaqah.grade);

			var guruQuranNama = $('#guru-quran-nama');
			guruQuranNama.text(users);

			var kelasInfo = $('#kelas-info');
			kelasInfo.text(selectedKelompokHalaqah.kelas.nama);

			var gradeInfo = $('#grade-info');
			gradeInfo.text(selectedKelompokHalaqah.grade);

			$('#kelompok-halaqah-column').show();
		});
	});
</script>
@endsection