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
                                    <div class="card-title">Cari Kelompok Halaqah</div>
                                </div>
                                <div class="card-body">
                                    <div class="form row">
                                        <div class="form-group col-md-4 col-12">
                                            <label>Tahun Ajaran</label>
                                            <select class="form-control pt-0 pb-0" id="filterSelectTahunAjaran"
                                                autocomplete="false">
                                                @foreach (generateTahunAjaran() as $tahun)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
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
                                            <label>Pengampu</label>
                                            <select id="filterSelectPengampu" name="multiple[]" class="form-control"
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
                                <h4 class="card-title">Daftar Siswa Halaqah
                                    <span id="span-tahun-ajaran">{{ $tahun_ajaran }}</span>
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

            initFilterUnit()

            const dataGuru = {{ Illuminate\Support\Js::from($gurus) }};
            initSelectFilterByUnit("filterSelectPengampu", "Pilih Pengampu", dataGuru)

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
                {
                    type: 'array',
                    element: '#filterSelectKelas',
                    elementEnd: '',
                    columnIndex: columnNames['kelas'],
                },
                {
                    type: 'array',
                    element: '#filterSelectPengampu',
                    elementEnd: '',
                    columnIndex: columnNames['pengampu'],
                },
                {
                    type: 'string',
                    element: '#filterSiswa',
                    elementEnd: '',
                    columnIndex: columnNames['siswa'],
                },
            ]

            $(document).on('click', '#submitFilter', submitFilter)
                .on('click', '#resetFilter', resetFilter)
        })

        function submitFilter() {
            filterTable(dataFilter)
        }
    </script>
@endsection
