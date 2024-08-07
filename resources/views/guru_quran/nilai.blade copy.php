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
										<div class="form-group form-show-notify row">
											<div class="col-lg-1 col-md-3 col-sm-4 text-right">
												<label>Ujian</label>
											</div>
											<div class="col-lg-4 col-md-9 col-sm-8">
                                            <select class="form-control input-fixed" id="dropdown-ujian">
                                                @foreach($ujians as $ujian)
                                                    <option value="{{ $ujian->id }}">{{ $ujian->nama }}</option>
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
												<button id="displayKelompokHalaqah" class="btn btn-success">Tampilkan</button>
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
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="nilai-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
                                                    <th>Tanggal Ujian</th>
													<th>Nama Siswa</th>
													<th>Deskripsi</th>
													<th>Penyimak</th>
													<th>Nilai</th>
													<th>Status</th>
                                                    <th style="width: 10%">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($nilais as $nilai)
													<tr data-kelompok-halaqah-id="{{ $nilai->siswa->kelompok_halaqah_id }}">>
                                                        <td>{{ $nilai->tanggal_ujian }}</td>
                                                        <td>{{ $nilai->siswa->nama }}</td>
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
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a href="/admin_pusat/{{ $nilai->id }}/edit" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <form action="" method="POST" class="d-inline">
                                                                 @csrf	
                                                                    @method('delete')
                                                                    <button class="btn btn-link btn-danger" data-toggle="tooltip" onclick="return confirm('Ingin menghapus admin ini?')" data-original-title="Hapus" type="submit">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
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
<script>
    $(document).ready(function() {
		$('#displayKelompokHalaqah').on('click', function() {
			var kelompokHalaqahId = $('#dropdown-kelompok-halaqah').val();
			var tableRows = $('#nilai-datatables tbody tr');
			tableRows.hide();
			var filteredRows = tableRows.filter(function() {
				return $(this).data('kelompok-halaqah-id') == kelompokHalaqahId;
			});
			filteredRows.show();
			
			filteredRows.each(function(index) {
				$(this).find('td:first').text(index + 1);
			});
			$('#kelompok-halaqah-column').show();

			var selectedOptionText = $('#dropdown-kelompok-halaqah option:selected').text();
		});
	});
</script>
@endsection