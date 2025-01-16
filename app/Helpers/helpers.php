<?php

/**
 * Format an amount to the given currency
 *
 * @return response()
 */

use Carbon\Carbon;
use App\Models\Faculty;
use App\Models\Prodi;


if (! function_exists('formatCurrency')) {
    function formatCurrency($amount, $currency)
    {
        $fmt = new NumberFormatter( 'id_ID', NumberFormatter::CURRENCY );
        $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
        return $fmt->formatCurrency($amount, $currency);
    }
}

if (! function_exists('money')) {
    function money($amount)
    {
        // return formatCurrency($amount, 'IDR');
        return 'Rp '. number_format($amount,0,',','.');
    }
}


if (! function_exists('angka')) {
    function angka($angka)
    {
        return number_format($angka,0,',','.');
    }
}

if (! function_exists('penyebut')) {
    function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }
}

if (! function_exists('terbilang')) {
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }
}

if (! function_exists('sumFakultas')) {
    function sumFakultas()
    {
        return Faculty::count();
    }
}

if (! function_exists('sumProdi')) {
    function sumProdi()
    {
        return Prodi::count();
    }
}

if (! function_exists('sumProdiTerakreditasi')) {
    function sumProdiTerakreditasi()
    {
        return Prodi::count();
    }
}

if (! function_exists('sumProdiUnggul')) {
    function sumProdiUnggul()
    {
        return Prodi::whereHas('currentAkreditasi', function ($query) {
            $query->where('peringkat', 'UNGGUL'); 
        })->count();
    }
}

if (! function_exists('sumProdiA')) {
    function sumProdiA()
    {
        return Prodi::whereHas('currentAkreditasi', function ($query) {
            $query->where('peringkat', 'A'); 
        })->count();
    }
}

if (! function_exists('sumProdiBaikSekali')) {
    function sumProdiBaikSekali()
    {
        return Prodi::whereHas('currentAkreditasi', function ($query) {
            $query->where('peringkat', 'BAIK SEKALI'); 
        })->count();
    }
}

if (! function_exists('sumProdiB')) {
    function sumProdiB()
    {
        return Prodi::whereHas('currentAkreditasi', function ($query) {
            $query->where('peringkat', 'B'); 
        })->count();
    }
}

if (! function_exists('sumProdiBaik')) {
    function sumProdiBaik ()
    {
        return Prodi::whereHas('currentAkreditasi', function ($query) {
            $query->where('peringkat', 'BAIK'); 
        })->count();
    }
}

if (! function_exists('sumProdiSementara')) {

    function sumProdiSementara()
    {
        return Prodi::whereHas('currentAkreditasi', function ($query) {
            $query->where('peringkat', 'SEMENTARA'); 
        })->count();
    }
}

if (! function_exists('sumProdiBelumTerakreditasi')) {
    function sumProdiBelumTerakreditasi()
    {
        return Prodi::whereDoesntHave('currentAkreditasi')->count();
    }
}

if (! function_exists('sumProdiInternasional')) {
    function sumProdiInternasional()
    {
        return Prodi::whereHas('currentAkreditasiInternasional')->count();
    }
}

if (! function_exists('sumProdiAsiin')) {
    function sumProdiAsiin()
    {
        return Prodi::whereHas('currentAkreditasiInternasional', function ($query) {
            $query->where('lembaga_id', 8); 
        })->count();
    }
}

if (! function_exists('sumProdiIabee')) {
    function sumProdiIabee()
    {
        return Prodi::whereHas('currentAkreditasiInternasional', function ($query) {
            $query->where('lembaga_id', 11); 
        })->count();
    }
}

if (! function_exists('sumProdiAqas')) {
    function sumProdiAqas()
    {
        return Prodi::whereHas('currentAkreditasiInternasional', function ($query) {
            $query->where('lembaga_id', 10); 
        })->count();
    }
}

if (! function_exists('sumProdiFibaa')) {
    function sumProdiFibaa()
    {
        return Prodi::whereHas('currentAkreditasiInternasional', function ($query) {
            $query->where('lembaga_id', 9); 
        })->count();
    }
}

if (! function_exists('sumProdiBelumTerakreditasiInternasional')) {
    function sumProdiBelumTerakreditasiInternasional()
    {
        return Prodi::whereDoesntHave('currentAkreditasiInternasional')->count();
    }
}
?>
