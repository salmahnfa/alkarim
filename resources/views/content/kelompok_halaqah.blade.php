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
                                <div class="form row px-0">
                                    <div class="form-group form-show-validation row col-lg-6 col-md-6 col-12">
                                        <label class="col-lg-3 col-md-4 col-sm-4 text-md-right text-left mt-sm-2">Tahun
                                            Ajaran</label>
                                        <div class="col-lg-9 col-md-8 col-sm-8">
                                            <select class="form-control pt-0 pb-0" id="select-tahun-ajaran">
                                                @foreach (generateTahunAjaran() as $tahun)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun_ajaran == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form-show-validation row col-lg-6 col-md-6 col-12">
                                        <label
                                            class="col-lg-3 col-md-4 col-sm-4 text-md-right text-left mt-sm-2">Unit</label>
                                        <div class="col-lg-9 col-md-8 col-sm-8">
                                            <select class="form-control pt-0 pb-0" id="select-unit">
                                                <option value="">Semua</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->nama }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button id="submitFilter" class="btn btn-success">Tampilkan</button>
                                <button id="resetFilter" class="btn btn-danger">Reset</button>
                            </div>
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
        $(document).ready(function() {
            $(document).on('click', '#submitFilter', filterTable)
            .on('click', '#resetFilter', resetFilter)

            function filterTable() {
                filterUnit = $('#select-unit').val();
                LaravelDataTables['{{ $dataTable->getTableId() }}'].column(1).search(filterUnit);

                filterTahunAjaran = $('#select-tahun-ajaran').val()
                LaravelDataTables['{{ $dataTable->getTableId() }}'].column(5).search(filterTahunAjaran);

                LaravelDataTables['{{ $dataTable->getTableId() }}'].draw();

                $('#span-tahun-ajaran').text(filterTahunAjaran)
            }

            function resetFilter() {
                $('#select-unit').val('');
                $('#select-tahun-ajaran').val('{{ $tahun_ajaran }}')
                $('#span-tahun-ajaran').text('{{ $tahun_ajaran }}')

                LaravelDataTables['{{ $dataTable->getTableId() }}']
                .column(1).search('')
                .column(5).search('')
                .draw();
            }
        });
    </script>
@endsection
