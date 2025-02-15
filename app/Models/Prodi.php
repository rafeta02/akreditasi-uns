<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Prodi extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory, Sluggable;

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
        'slug',
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
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'nama_prodi',
        'file_sk_pendirian'
    ];

    public function getNamaProdiAttribute()
    {
        return $this->jenjang ? $this->jenjang->name . ' ' . $this->name_dikti : $this->name_dikti;
    }

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['jenjang.name', 'name_dikti'],
                'separator' => '-', // Custom separator
                'maxLength' => 50, // Maximum length of the slug
            ]
        ];
    }

    public function allAkreditasi(): HasMany
    {
        return $this->hasMany(Akreditasi::class)->orderBy('tgl_akhir_sk');
    }


    public function currentAkreditasi()
    {
        return $this->hasOne(Akreditasi::class)
            ->whereDate('tgl_awal_sk', '<=', Carbon::today())
            ->whereDate('tgl_akhir_sk', '>=', Carbon::today());
    }


    public function currentAkreditasiInternasional()
    {
        return $this->hasOne(AkreditasiInternasional::class)
            ->whereDate('tgl_awal_sk', '<=', Carbon::today())
            ->whereDate('tgl_akhir_sk', '>=', Carbon::today());
    }

    public function getFileSkPendirianAttribute()
    {
        return $this->getMedia('file_sk_pendirian');
    }

}
