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
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Daftar Siswa Halaqah</h4>
                                <select class="form-control input-fixed" id="select-tahun-ajaran">
                                    @foreach (generateTahunAjaran() as $tahun)
                                        <option value="{{ $tahun }}" {{ $tahun_ajaran == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pengampu</th>
                                                <th>Kelompok</th>
                                                <th>Siswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($guru_qurans as $guru_quran)
                                                <tr>
                                                    @php
                                                        $totalKel = $guru_quran->kelompokHalaqahs->count() + 1;
                                                    @endphp
                                                    <td rowspan="{{ $totalKel }}">{{ $loop->iteration }}</td>
                                                    <td rowspan="{{ $totalKel }}">{{ $guru_quran->user->nama }}</td>
                                                </tr>
                                                @foreach ($guru_quran->kelompokHalaqahs as $kelompok_halaqah)
                                                    <tr>
                                                        <td>
                                                            {{ $kelompok_halaqah->kelas->nama }} -
                                                            {{ $kelompok_halaqah->grade }}
                                                        </td>
                                                        <td>
                                                            @foreach ($kelompok_halaqah->siswas as $siswa)
                                                                {{ $siswa->nama }}<br>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            @if (!$guru_qurans->count())
                                                <tr>
                                                    <td colspan="9" class="text-center">Belum ada data yang dimasukkan.
                                                    </td>
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
            // $('#basic-datatables').DataTable();

            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });

            $('#select-tahun-ajaran').change(function() {
                window.location = '{{route('admin_pusat.kelompok_halaqah')}}/' + $(this).val()
            })
        });
    </script>
@endsection
