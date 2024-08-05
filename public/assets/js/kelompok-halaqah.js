$(document).ready(function() {
    $('#kelompok-halaqah-datatables').DataTable({
        "data": siswas,
        "paging": false,
        "searching": false,
    });

    $('#displayData').on('click', function() {
        var kelompokHalaqahId = $('#dropdown-kelompok-halaqah').val();
        var filteredRows = siswas.filter(function(siswa) {
            return siswa.kelompok_halaqah_id == kelompokHalaqahId;
        });

        var tbody = $('#kelompok-halaqah-datatables tbody');
        tbody.empty();

        if (filteredRows.length > 0) {
            filteredRows.forEach(function(siswa, index) {
                var row = $('<tr>');
                row.append('<td>' + (index + 1) + '</td>');
                row.append('<td>' + siswa.nisn + '</td>');
                row.append('<td>' + siswa.nama + '</td>');
                row.append('<td>' + siswa.surah.nama + '</td>');
                row.append('<td>' + siswa.jilid.nama + '</td>');
                tbody.append(row);
            });
        } else {
            var noDataRow = $('<tr><td colspan="9" class="text-center">Belum ada data yang dimasukkan.</td></tr>');
            tbody.append(noDataRow);
        }

        $('#kelompok-halaqah-column').show();

        var selectedOptionText = $('#dropdown-kelompok-halaqah option:selected').text();

        var cardTitle = $('#kelompok-halaqah-column .card-title');
        cardTitle.text('Kelompok ' + selectedOptionText);
    });
});