<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodi extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'prodis';

    protected $dates = [
        'tanggal_berdiri',
        'tgl_sk_izin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'fakultas_id',
        'jenjang_id',
        'code_siakad',
        'nim',
        'name_dikti',
        'name_akreditasi',
        'name_en',
        'gelar',
        'gelar_en',
        'tanggal_berdiri',
        'sk_izin',
        'tgl_sk_izin',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function fakultas()
    {
        return $this->belongsTo(Faculty::class, 'fakultas_id');
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function getTanggalBerdiriAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalBerdiriAttribute($value)
    {
        $this->attributes['tanggal_berdiri'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTglSkIzinAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglSkIzinAttribute($value)
    {
        $this->attributes['tgl_sk_izin'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
