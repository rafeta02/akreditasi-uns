<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Prodi;
use App\Models\Akreditasi;
use App\Models\LembagaAkreditasi;
use Carbon\Carbon;


class AkreditasiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $row
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $prodi = Prodi::where('code', $row['prodi'])->first();
            if (!$prodi) {
                dd($row['prodi']);
            }
            
            $lembaga = LembagaAkreditasi::where('code', $row['lembaga'])->first();

            Akreditasi::create([
                'fakultas_id' => $prodi->fakultas_id,
                'prodi_id' => $prodi->id,
                'jenjang_id' => $prodi->jenjang_id,
                'lembaga_id' => $lembaga->id ?? '',
                'no_sk' => $row['no_sk'],
                'tgl_sk' => is_numeric($row['tgl_sk']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $row['tgl_sk']))->format('d-m-Y') : null,
                'tgl_awal_sk' => is_numeric($row['tgl_awal_sk']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $row['tgl_awal_sk']))->format('d-m-Y') : null,
                'tgl_akhir_sk' => is_numeric($row['tgl_akhir_sk']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $row['tgl_akhir_sk']))->format('d-m-Y') : null,
                'tahun_expired' => $row['tahun_expired'],
                'peringkat' => $row['peringkat'],
                'nilai' => $row['nilai'],
                'note' => 'IMPORT',
            ]);
        }
    }
}
