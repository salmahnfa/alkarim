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

        for ($i = $end + 1; $i >= $start; $i--) {
            $tahunAjaran[] = $i - 1  . '/' . $i;
        }

        return $tahunAjaran;
    }
}
