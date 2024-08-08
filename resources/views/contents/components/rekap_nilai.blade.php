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
                            <form id="formFilter">
                                <div class="card-header">
                                    <div class="card-title">Cari Rekap Nilai Siswa</div>
                                </div>
                                <div class="card-body">
                                    <div class="form row">
                                        <div class="form-group col-md-4 col-12">
                                            <label>Tahun Ajaran</label>
                                            <select class="form-control pt-0 pb-0" id="filterSelectTahunAjaran">
                                                @foreach (generateTahunAjaran() as $tahun)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div
                                            class="form-group col-md-4 col-12 {{ auth()->user()->role_id == 3 ? 'd-none' : '' }}">
                                            <label>Unit</label>
                                            <select class="form-control" id="filterSelectUnit" multiple="multiple">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->nama }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Kelas</label>
                                            <select id="filterSelectKelas" name="multiple[]" class="form-control"
                                                multiple="multiple">
                                                @foreach ($kelas as $dataKelas)
                                                    <option value="{{ $dataKelas->id }}">{{ $dataKelas->nama }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Tanggal ujian</label>
                                            <div class="input-group input-daterange">
                                                <input id="filterStartDate" type="text" class="form-control"
                                                    value="">
                                                <span class="input-group-text">
                                                    sampai
                                                </span>
                                                <input id="filterEndDate" type="text" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Penguji</label>
                                            <select id="filterSelectPenguji" name="multiple[]" class="form-control"
                                                multiple="multiple">
                                                @foreach ($gurus as $guru)
                                                    <option value="{{ $guru->id }}">{{ $guru->nama }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Siswa</label>
                                            <input type="text" class="form-control" id="filterSiswa"
                                                placeholder="Masukkan nama atau NISN siswa">
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Nilai</label>
                                            <div class="input-group">
                                                <input id="filterStartNilai" type="number"
                                                    class="form-control input-number">
                                                <span class="input-group-text">
                                                    sampai
                                                </span>
                                                <input id="filterEndNilai" type="number" class="form-control input-number">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Tipe Ujian</label>
                                            <div>
                                                @foreach ($ujians as $ujian)
                                                    <div class="form-check form-check-inline ">
                                                        <input name="filter_ujian[]" class="form-check-input mb-2"
                                                            type="checkbox" value="{{ $ujian->id }}"
                                                            id="checkboxUjian{{ $ujian->id }}" style="left: auto">
                                                        <label class="form-check-label ml-3"
                                                            for="checkboxUjian{{ $ujian->id }}">
                                                            {{ $ujian->nama }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Status</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="filter_status"
                                                        id="checkboxStatusLulus" value="1">
                                                    <label class="form-check-label ml-1 mt-sm-2 mr-1"
                                                        for="checkboxStatusLulus">
                                                        Lulus
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="filter_status"
                                                        id="checkboxStatusTidakLulus" value="0">
                                                    <label class="form-check-label ml-1 mt-sm-2 mr-1"
                                                        for="checkboxStatusTidakLulus">
                                                        Tidak Lulus
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <a id="submitFilter" class="btn btn-success text-white">Tampilkan</a>
                                    <a id="resetFilter" class="btn btn-danger text-white">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Daftar Rekap Nilai Siswa
                                    <span id="spanTahunAjaran">{{ $tahun_ajaran }}</span>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{ $dataTable->table(['class' => 'display table table-striped table-hover']) }}
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
    {{ $dataTable->scripts() }}

    @include('contents.script._datatable_script')

    <script>
        let columnNames = {};
        let dataFilter = [];
        $(document).ready(function() {
            let columnDataTables = LaravelDataTables['{{ $dataTable->getTableId() }}'].settings().init().columns;

            LaravelDataTables['{{ $dataTable->getTableId() }}'].columns().every(function(index) {
                columnNames[columnDataTables[index].name] = index
            });

            initFilterDate()
            initFilterUnit()
            initInputNumber()

            const dataGuru = {{ Illuminate\Support\Js::from($gurus) }};
            initSelectFilterByUnit("filterSelectPenguji", "Pilih Penguji", dataGuru)

            const dataKelas = {{ Illuminate\Support\Js::from($kelas) }};
            initSelectFilterByUnit("filterSelectKelas", "Pilih Kelas", dataKelas)

            dataFilter = [{
                    type: 'string',
                    element: '#filterSelectTahunAjaran',
                    elementEnd: '',
                    columnIndex: columnNames['tahun_ajaran'],
                },
                {
                    type: 'array',
                    element: '#filterSelectUnit',
                    elementEnd: '',
                    columnIndex: columnNames['unit'],
                },
                // {
                //     type: 'array',
                //     element: '#filterSelectKelas',
                //     elementEnd: '',
                //     columnIndex: columnNames['kelas'],
                // },
                {
                    type: 'range',
                    element: '#filterStartDate',
                    elementEnd: '#filterEndDate',
                    columnIndex: columnNames['tanggal_ujian'],
                },
                {
                    type: 'array',
                    element: '#filterSelectPenguji',
                    elementEnd: '',
                    columnIndex: columnNames['penguji'],
                },
                {
                    type: 'string',
                    element: '#filterSiswa',
                    elementEnd: '',
                    columnIndex: columnNames['nama_siswa'],
                },
                {
                    type: 'checkbox',
                    element: 'filter_ujian[]',
                    elementEnd: '',
                    columnIndex: columnNames['ujian'],
                },
                {
                    type: 'radio',
                    element: 'filter_status[]',
                    elementEnd: '',
                    columnIndex: columnNames['status'],
                },
                {
                    type: 'range',
                    element: '#filterStartNilai',
                    elementEnd: '#filterEndNilai',
                    columnIndex: columnNames['nilai'],
                },
            ]

            $(document).on('click', '#submitFilter', submitFilter)
                .on('click', '#resetFilter', resetFilter)
        })

        function submitFilter() {
            filterTable(dataFilter)
        }

        function initFilterDate() {
            filterStartDate = $('#filterStartDate').datepicker({
                format: "dd M yyyy",
                clearBtn: true,
            });

            filterEndDate = $('#filterEndDate').datepicker({
                format: "dd M yyyy",
                endDate: "{{ Carbon\Carbon::now() }}",
                clearBtn: true,
            });

            filterStartDate.datepicker().on('changeDate', function(date) {
                filterEndDate.datepicker('setStartDate', date.date);
            })

            filterEndDate.datepicker().on('changeDate', function(date) {
                filterStartDate.datepicker('setEndDate', date.date);
            })
        }

        function initInputNumber() {
            $('.input-number').on("keypress", function(evt) {
                if (evt.which < 48 || evt.which > 57) {
                    evt.preventDefault();
                }
            });
        }
    </script>
@endsection
