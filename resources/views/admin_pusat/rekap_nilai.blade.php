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
                                            <select class="form-control pt-0 pb-0" id="filtetSelectTahunAjaran">
                                                @foreach (generateTahunAjaran() as $tahun)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Unit</label>
                                            <select class="form-control" id="filtetSelectUnit" multiple="multiple">
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->nama }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 col-12">
                                            <label>Kelas</label>
                                            <select id="filtetSelectKelas" name="multiple[]" class="form-control"
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
                                            <select id="filtetSelectPenguji" name="multiple[]" class="form-control"
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
                                                <div class="form-check form-check-inline ">
                                                    <input name="filter_status[]" class="form-check-input mb-2"
                                                        type="checkbox" value="1" id="checkboxStatusLulus"
                                                        style="left: auto">
                                                    <label class="form-check-label ml-3" for="checkboxStatusLulus">
                                                        Lulus
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input name="filter_status[]" class="form-check-input mb-2"
                                                        type="checkbox" value="0" id="checkboxStatusTidakLulus"
                                                        style="left: auto">
                                                    <label class="form-check-label ml-3" for="checkboxStatusTidakLulus">
                                                        Tidak Lulus
                                                    </label>
                                                </div>
                                            </div>
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
                                {{ $dataTable->table(['class' => 'display table table-striped table-hover']) }}
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
            initSelectFilterByUnit("filtetSelectPenguji", "Pilih Penguji", dataGuru)

            const dataKelas = {{ Illuminate\Support\Js::from($kelas) }};
            initSelectFilterByUnit("filtetSelectKelas", "Pilih Kelas", dataKelas)

            dataFilter = [{
                    type: 'string',
                    element: '#filtetSelectTahunAjaran',
                    elementEnd: '',
                    columIndex: columnNames['tahun_ajaran'],
                },
                {
                    type: 'array',
                    element: '#filtetSelectUnit',
                    elementEnd: '',
                    columIndex: columnNames['unit'],
                },
                // {
                //     type: 'array',
                //     element: '#filtetSelectKelas',
                //     elementEnd: '',
                //     columIndex: columnNames['kelas'],
                // },
                {
                    type: 'range',
                    element: '#filterStartDate',
                    elementEnd: '#filterEndDate',
                    columIndex: columnNames['tanggal_ujian'],
                },
                {
                    type: 'array',
                    element: '#filtetSelectPenguji',
                    elementEnd: '',
                    columIndex: columnNames['penguji'],
                },
                {
                    type: 'string',
                    element: '#filterSiswa',
                    elementEnd: '',
                    columIndex: columnNames['nama_siswa'],
                },
                {
                    type: 'checkbox',
                    element: 'filter_ujian[]',
                    elementEnd: '',
                    columIndex: columnNames['ujian'],
                },
                {
                    type: 'checkbox',
                    element: 'filter_status[]',
                    elementEnd: '',
                    columIndex: columnNames['status'],
                },
                {
                    type: 'range',
                    element: '#filterStartNilai',
                    elementEnd: '#filterEndNilai',
                    columIndex: columnNames['nilai'],
                },
            ]

            $(document).on('click', '#submitFilter', submitFilter)
                .on('click', '#resetFilter', resetFilter)
        })



        function submitFilter() {
            filterTable(dataFilter)
        }


        /*
            param dataFilter is array of object that contain:
            - type (string / array / range)
            - element name of filter field (id / class / name)
            - element name of filter field end, only when type is range (id / class / name)
            - column index at datatable

            param tahunAjaranFilterEl is element of filter tahun ajaran
            param tahunAjaranEl is element that of display tahun ajaran
        */

        function filterTable(dataFilter, tahunAjaranFilterEl = "#filtetSelectTahunAjaran",
            tahunAjaranEl = "#spanTahunAjaran") {
            console.log(dataFilter)
            $.each(dataFilter, function(key, filter) {
                switch (filter.type) {
                    case 'array':
                        filterEl = $(filter.element);
                        if (filterEl.val()) {
                            filterValue = filterEl.val().toString();
                            LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columIndex)
                                .search(filterValue);
                        }
                        break;
                    case 'checkbox':
                        filterEl = $('input[name="' + filter.element + '"]:checked');
                        console.log(filterEl);
                        filterValue = []
                        if (filterEl) {
                            filterEl.each(function() {
                                filterValue.push(this.value)
                            });
                            LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columIndex)
                                .search(filterValue.toString());
                        }
                        break;
                    case 'range':
                        filterEl = $(filter.element);
                        filterElEnd = $(filter.elementEnd);
                        if (filterEl.val() && filterElEnd.val()) {
                            filterStartValue = filterEl.val().toString();
                            filterEndValue = filterElEnd.val().toString();
                            LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columIndex)
                                .search(filterStartValue + "-" + filterEndValue);
                        }
                        break;
                    default:
                        filterEl = $(filter.element);
                        if (filterEl.val()) {
                            filterValue = filterEl.val();
                            LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columIndex)
                                .search(filterValue);
                        }
                }
            })

            LaravelDataTables['{{ $dataTable->getTableId() }}'].draw();
            $(tahunAjaranEl).text($(tahunAjaranFilterEl).val())
        }

        function resetFilter() {
            $('#formFilter')[0].reset()
            $('#filtetSelectTahunAjaran').val('{{ $tahun_ajaran }}')
            $('#spanTahunAjaran').text('{{ $tahun_ajaran }}')

            LaravelDataTables['{{ $dataTable->getTableId() }}']
                .columns().search('')
                .draw();
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

        function initFilterUnit() {
            $('#filtetSelectUnit').select2({
                theme: "bootstrap",
                placeholder: "Pilih Unit",
            });
        }

        function initSelectFilterByUnit(selectIdName, placeholder, dataList) {
            const selectEl = $('#' + selectIdName)
            const selectUnit = $('#filtetSelectUnit')

            selectEl.select2({
                theme: "bootstrap",
                placeholder: placeholder,
            });

            selectUnit.on('change', function() {
                const selectUnitEl = $(this)
                selectEl.empty().trigger('change');

                $.each(dataList, function(key, data) {
                    if (
                        selectUnitEl.val() == "" ||
                        $.inArray(data.unit_id.toString(), selectUnitEl.val()) != -1
                    ) {
                        const newOption = new Option(data.nama, data.id, false, false);
                        selectEl.append(newOption).trigger('change');
                    }
                });

                selectEl.val(null).trigger('change')
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
