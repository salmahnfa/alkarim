<script>
    /*
        dataFilter = [
            {
                type: 'checkbox',                   => string / array / range / checkbox
                element: 'filter_ujian[]',          => nama id atau class dari field filter
                elementEnd: '',                     => nama id atau class dari field filter (hanya untuk tipe "range")
                columnIndex: columnNames['ujian'],   => index kolom di datatable
            },
            {
                type: 'radio',
                element: 'filter_status',
                elementEnd: '',
                columnIndex: columnNames['status'],
            },
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
        ]

        tahunAjaranFilterEl => nama id select filter tahun ajaran
        utahunAjaranEl => nama id atau class yg menampilkan text tahun ajaran
    */

    function filterTable(
        dataFilter,
        tahunAjaranFilterEl = "#filterSelectTahunAjaran",
        tahunAjaranEl = "#spanTahunAjaran"
    ) {
        $.each(dataFilter, function(key, filter) {
            switch (filter.type) {
                case 'array':
                    filterEl = $(filter.element);

                    if (filterEl.val()) {
                        filterValue = filterEl.val().toString();
                        LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columnIndex)
                            .search(filterValue);
                    }
                    break;

                case 'checkbox':
                    filterEl = $('input[name="' + filter.element + '"]:checked');
                    filterValue = []

                    if (filterEl) {
                        filterEl.each(function() {
                            filterValue.push(this.value)
                        });

                        LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columnIndex)
                            .search(filterValue.toString());
                    }
                    break;

                case 'radio':
                    filterEl = $('input[name="' + filter.element + '"]:checked');

                    if (filterEl.val()) {
                        filterValue = filterEl.val();

                        LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columnIndex)
                            .search(filterValue);
                    }
                    break;

                case 'range':
                    filterEl = $(filter.element);
                    filterElEnd = $(filter.elementEnd);

                    if (filterEl.val() && filterElEnd.val()) {
                        filterStartValue = filterEl.val().toString();
                        filterEndValue = filterElEnd.val().toString();

                        LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columnIndex)
                            .search(filterStartValue + "-" + filterEndValue);
                    }
                    break;

                default:
                    filterEl = $(filter.element);
                    if (filterEl.val()) {
                        filterValue = filterEl.val();

                        LaravelDataTables['{{ $dataTable->getTableId() }}'].column(filter.columnIndex)
                            .search(filterValue);
                    }
            }
        })

        LaravelDataTables['{{ $dataTable->getTableId() }}'].draw();
        $(tahunAjaranEl).text($(tahunAjaranFilterEl).val())
    }

    function resetFilter(
        event,
        formFilter = 'formFilter',
        tahunAjaranFilterEl = "#filterSelectTahunAjaran",
        tahunAjaranEl = "#spanTahunAjaran"
    ) {
        $('#' + formFilter)[0].reset()
        $(tahunAjaranFilterEl).val('{{ $tahun_ajaran }}')
        $(tahunAjaranEl).text('{{ $tahun_ajaran }}')

        var form = $('#' + formFilter),
            inputs = form.find(':input');

            setTimeout(function() {
                inputs.trigger('change');
            }, 50);

        LaravelDataTables['{{ $dataTable->getTableId() }}']
            .columns().search('')
            .draw();
    }

    function initFilterUnit() {
        $('#filterSelectUnit').select2({
            theme: "bootstrap",
            placeholder: "Pilih Unit",
        });
    }

    function initSelectFilterByUnit(selectIdName, placeholder, dataList) {
        const selectEl = $('#' + selectIdName)
        const selectUnit = $('#filterSelectUnit')

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
</script>
