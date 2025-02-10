<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\UraianLogbook;
use App\Models\LogbookAkreditasi;
use Carbon\Carbon;


class LogbookAkreditasiImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $uraian = UraianLogbook::where('slug', $row['uraian'])->first();
            
            LogbookAkreditasi::create([
                'tugas'  => $row['tugas'],
                'uraian_id' => $uraian ? $uraian->id : null,
                'detail'  => $row['detail'],
                'tanggal' => is_numeric($row['tanggal']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $row['tanggal']))->format('d-m-Y') : null,
                'jumlah' => $row['jumlah'],
                'satuan'  => $row['satuan'],
                'keterangan'  => $row['keterangan'],
                'user_id' => auth()->id()
            ]);
        }
    }
}
