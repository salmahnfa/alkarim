<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('generateTahunAjaran')) {
    function generateTahunAjaran()
    {
        $start = config('alkarim.tahun_ajaran_start');
        $end = Date::now()->year;
        $tahunAjaran = [];

        for ($i = $start; $i <= $end; $i++) {
            $tahunAjaran[] = $i . '/' . $i + 1;
        }

        return $tahunAjaran;
    }
}
