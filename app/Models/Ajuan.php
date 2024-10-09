<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Ajuan extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'ajuans';

    protected $appends = [
        'bukti_upload',
    ];

    protected $dates = [
        'tgl_ajuan',
        'tgl_diterima',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_AJUAN_SELECT = [
        'submit' => 'Submit Dokumen',
        'proses' => 'Menunggu Proses Akreditasi',
        'revisi' => 'Revisi Dokumen',
        'terbit' => 'Penerbitan SK dan Sertifikat',
    ];

    protected $fillable = [
        'fakultas_id',
        'prodi_id',
        'jenjang_id',
        'lembaga_id',
        'tgl_ajuan',
        'tgl_diterima',
        'status_ajuan',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function fakultas()
    {
        return $this->belongsTo(Faculty::class, 'fakultas_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function lembaga()
    {
        return $this->belongsTo(LembagaAkreditasi::class, 'lembaga_id');
    }

    public function getTglAjuanAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglAjuanAttribute($value)
    {
        $this->attributes['tgl_ajuan'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTglDiterimaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglDiterimaAttribute($value)
    {
        $this->attributes['tgl_diterima'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBuktiUploadAttribute()
    {
        $files = $this->getMedia('bukti_upload');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
