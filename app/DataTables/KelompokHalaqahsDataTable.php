<?php

namespace App\DataTables;

use App\Models\KelompokHalaqah;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KelompokHalaqahsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('kelompok', function (KelompokHalaqah $data) {
                return $data->kelas->nama . ' - ' . $data->grade;
            })
            ->addColumn('pengampu', function (KelompokHalaqah $data) {
                if (!isset($data->guruQuran)) return '-';
                return $data->guruQuran->user->nama;
            })
            ->addColumn('siswa', function (KelompokHalaqah $data) {
                $siswas = "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jilid</th>
                            <th>Surah</th>
                        </tr>
                    </thead>";

                foreach ($data->siswas as $siswa) {
                    $siswas .= "<tr class='bg-white'><td>" . $siswa->nisn . "</td>" .
                        "<td>" . $siswa->nama . '</td>' .
                        "<td>" . $siswa->jilid->nama . '</td>' .
                        "<td>" . $siswa->surah->nama . '</td></tr>';
                }

                $siswas .= "</tbody></table>";

                return $siswas;
            })
            ->addColumn('unit', function (KelompokHalaqah $data) {
                return $data->unit->nama;
            })
            ->addColumn('action', 'kelompokhalaqahs.action')
            ->rawColumns(['siswa', 'action'])
            ->addIndexColumn()
            ->filterColumn('tahun_ajaran', function ($query, $keyword) {
                $query->where('tahun_ajaran', '=', ["{$keyword}"]);
            })
            ->filterColumn('unit', function ($query, $keyword) {
                $query->whereIn('unit_id', explode(',', $keyword));
            })
            ->filterColumn('kelas', function ($query, $keyword) {
                $query->whereIn('kelas_id', explode(',', $keyword));
            })
            ->filterColumn('pengampu', function ($query, $keyword) {
                $query->whereIn('guru_quran_id', explode(',', $keyword));
            })
            ->filterColumn('siswa', function ($query, $keyword) {
                $query->whereHas('siswas', function ($q) use ($keyword) {
                    $q->whereRaw("lower(nama) like (?)", ["%{$keyword}%"])
                        ->orWhereRaw("lower(nisn) like (?)", ["%{$keyword}%"]);
                });
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KelompokHalaqah $model): QueryBuilder
    {
        $query = $model->newQuery();

        $tahun_ajaran = $this->tahun_ajaran;
        if (isset($this->request->columns[0]['search']['value'])) {
            $tahun_ajaran =  $this->request->columns[0]['search']['value'];
        } else {
            //default filter tahun ajaran saat ini
            $query->where('kelompok_halaqahs.tahun_ajaran', $tahun_ajaran);
        }

        $query->with([
            'siswas' => function ($query) use ($tahun_ajaran) {
                $query->wherePivot('tahun_ajaran', $tahun_ajaran);
            },
        ])
            ->orderBy('unit_id')
            ->orderBy('guru_quran_id', 'desc');

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('kelompokhalaqahs-table')
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
            Column::make('unit'),
            Column::make('pengampu'),
            Column::make('kelompok'),
            Column::make('siswa')->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'KelompokHalaqahs_' . date('YmdHis');
    }
}
