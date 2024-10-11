<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Faculty;
use App\Models\Jenjang;
use App\Models\Prodi;
use Carbon\Carbon;

class ProdiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $row
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $faculty = Faculty::where('code', $row['fakultas'])->first();
            $jenjang = Jenjang::where('code', $row['jenjang'])->first();
            Prodi::create([
                'code' => $row['code'],
                'fakultas_id' => $faculty->id,
                'jenjang_id' => $jenjang->id,
                'code_siakad' => $row['code_siakad'],
                'nim' => $row['nim'],
                'name_dikti' => $row['name_dikti'],
                'name_akreditasi' => $row['name_akreditasi'],
                'name_en' => $row['name_en'],
                'gelar' => $row['gelar'],
                'gelar_en' => $row['gelar_en'],
                'tanggal_berdiri' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_berdiri']))->format('d-m-Y'),
                'sk_izin' => $row['sk_izin'],
                'tgl_sk_izin' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_sk_izin']))->format('d-m-Y'),
            ]);
        }
    }
}
