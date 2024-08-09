<?php

namespace App\DataTables;

use App\Models\AdminUnit;
use App\Models\GuruQuran;
use App\Models\Kelas;
use App\Models\KelompokHalaqah;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NilaisDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('tanggal_ujian', function (Nilai $data) {
                return Carbon::parse($data->tanggal_ujian)->format('d M Y');
            })
            ->addColumn('nama_siswa', function (Nilai $data) {
                return $data->siswaKelas->siswa->nama;
            })
            ->addColumn('nisn_siswa', function (Nilai $data) {
                return $data->siswaKelas->siswa->nisn;
            })
            ->addColumn('kelas', function (Nilai $data) {
                return $data->siswaKelas->kelas->nama;
            })
            ->addColumn('grade', function (Nilai $data) {
                return $data->siswaKelas->grade;
            })
            ->addColumn('ujian', function (Nilai $data) {
                return $data->ujian->nama;
            })
            ->addColumn('penyimak', function (Nilai $data) {
                return $data->guruQuran->user->nama;
            })
            ->addColumn('unit', function (Nilai $data) {
                if (!isset($data->unit)) return '-';
                return $data->unit->nama;
            })
            ->addColumn('status', function (Nilai $data) {
                $min = config('alkarim.min_nilai_ujian_lulus');
                $badge = '';

                $data->nilai >= $min ?
                    $badge = '<span class="badge badge-success">Lulus</span>' :
                    $badge = '<span class="badge badge-danger">Tidak Lulus</span>';

                return $badge;
            })
            ->addColumn('tanggal_ujian_akhir', function (Nilai $data) {
                return $data->tanggal_ujian;
            })
            ->rawColumns(['status'])
            ->addIndexColumn()
            ->filterColumn('tahun_ajaran', function ($query, $keyword) {
                $query->where('tahun_ajaran', '=', ["{$keyword}"]);
            })
            ->filterColumn('unit', function ($query, $keyword) {
                $query->whereIn('unit_id', explode(',', $keyword));
            })
            ->filterColumn('tanggal_ujian', function ($query, $keyword) {
                $filterDate = explode("-", $keyword);
                if (!empty($filterDate[0])) {
                    $query->where('tanggal_ujian', '>=', Carbon::parse($filterDate[0])->format("Y-m-d"));
                }
                if (!empty($filterDate[1])) {
                    $query->where('tanggal_ujian', '<=', Carbon::parse($filterDate[1])->format("Y-m-d"));
                }
            })
            ->filterColumn('penyimak', function ($query, $keyword) {
                $query->whereIn('guru_quran_id', explode(',', $keyword));
            })
            ->filterColumn('nama_siswa', function ($query, $keyword) {
                $siswas = Siswa::whereRaw("lower(nama) like (?)", ["%{$keyword}%"])
                    ->orWhereRaw("lower(nisn) like (?)", ["%{$keyword}%"])
                    ->select('id')->get()->toArray();

                $query->whereIn('siswa_id', $siswas);
            })
            ->filterColumn('kelas', function ($query, $keyword) {
                $tahun_ajaran = $this->tahun_ajaran;

                if (isset($this->request->columns[0]['search']['value'])) {
                    $tahun_ajaran =  $this->request->columns[0]['search']['value'];
                }

                $siswaKelas = SiswaKelas::whereIn('kelas_id', explode(',', $keyword))
                    ->where('tahun_ajaran', '=', $tahun_ajaran)
                    ->select('id')->get()->toArray();

                $query->whereIn('siswa_kelas_id', $siswaKelas);
            })
            ->filterColumn('ujian', function ($query, $keyword) {
                $query->whereIn('ujian_id', explode(',', $keyword));
            })
            ->filterColumn('nilai', function ($query, $keyword) {
                $filter = explode("-", $keyword);
                if (!empty($filter[0])) {
                    $query->where('nilai', '>=', $filter[0]);
                }
                if (!empty($filter[1])) {
                    $query->where('nilai', '<=', $filter[1]);
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                $min = config('alkarim.min_nilai_ujian_lulus');

                $keyword == 1 ?
                    $query->where('nilai', '>=', $min) :
                    $query->where('nilai', '<', $min);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Nilai $model): QueryBuilder
    {
        $query = $model->newQuery()
            ->with(['unit', 'ujian', 'guruQuran.user', 'siswaKelas.siswa', 'siswaKelas.kelas'])
            ->orderBy('nilais.unit_id');


        $tahun_ajaran = $this->tahun_ajaran;

        if (isset($this->request->columns[0]['search']['value'])) {
            $tahun_ajaran =  $this->request->columns[0]['search']['value'];
        } else {
            //default filter tahun ajaran saat ini
            $query->where('nilais.tahun_ajaran', $tahun_ajaran);
        }

        if (auth()->user()->role_id == 3) {
            $adminUnit = AdminUnit::where('user_id', auth()->user()->id)->first();
            if ($adminUnit) {
                $query->where('unit_id', $adminUnit->unit_id);
            }
        }

        switch (auth()->user()->role_id) {
            case 3:
                $adminUnit = AdminUnit::where('user_id', auth()->user()->id)->first();
                if ($adminUnit) {
                    $query->where('unit_id', $adminUnit->unit_id);
                }
                break;

            case 4:
                $guruQuran = GuruQuran::where('user_id', auth()->user()->id)->first();
                if ($guruQuran) {
                    $query->where('unit_id', $guruQuran->unit_id);

                    //filter siswa yg ada di kelompok halaqah guru yg sedang login
                    $halaqahId = KelompokHalaqah::where('tahun_ajaran', $tahun_ajaran)
                        ->where('guru_quran_id', $guruQuran->id)
                        ->select('id')
                        ->get()->toArray();

                    $siswaKelasId = SiswaKelas::whereIn('kelompok_halaqah_id', $halaqahId)
                        ->select('id')
                        ->get()->toArray();

                    $query->whereIn('siswa_kelas_id', $siswaKelasId);
                }

                break;
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Nilais-table')
            ->columns($this->getColumns())
            ->ordering(false)
            ->minifiedAjax();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('tahun_ajaran')->hidden(),
            Column::make('DT_RowIndex')->title('#')->orderable(false),
            Column::make('tanggal_ujian'),
            in_array(auth()->user()->role_id, [3, 4]) ? Column::make('unit')->hidden() : Column::make('unit'),
            Column::make('nisn_siswa')->title('NISN Siswa'),
            Column::make('nama_siswa'),
            Column::make('kelas'),
            Column::make('grade'),
            Column::make('ujian'),
            Column::make('deskripsi'),
            Column::make('penyimak'),
            Column::make('nilai'),
            Column::make('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Nilais_' . date('YmdHis');
    }
}
