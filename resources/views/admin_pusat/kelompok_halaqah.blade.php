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
                                    <div class="form-group form-show-validation row">
                                        <label class="col-lg-1 col-md-3 col-sm-4 text-right mt-sm-2">Unit</label>
                                        <div class="col-lg-4 col-md-9 col-sm-8">
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
            $('#select-tahun-ajaran').change(function() {
                window.location = '{{ route('admin_pusat.kelompok_halaqah') }}/' + $(this).val()
            })

            $(document).on('click', '#displayData', filterTable)

            function filterTable() {
                filterUnit = $('#select-unit').val();
                LaravelDataTables['{{ $dataTable->getTableId() }}'].column(1).search(filterUnit);
                if(filterUnit){
                }
                LaravelDataTables['{{ $dataTable->getTableId() }}'].draw();
            }
        });
    </script>
@endsection
