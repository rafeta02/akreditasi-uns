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
use Ulid\Ulid;

class Ajuan extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'ajuans';

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->ulid = (string) Ulid::generate();
        });
    }

    public const CLEAR_SELECT = [
        'done' => 'Done',
        'otw'  => 'On Progress',
    ];

    protected $appends = [
        'surat_tugas',
        'surat_pernyataan',
        'bukti_upload',
    ];

    public const TYPE_AJUAN_SELECT = [
        'isk'          => 'ISK',
        'reakreditasi' => 'Reakreditasi',
    ];

    protected $dates = [
        'tgl_ajuan',
        'tgl_diterima',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_AJUAN_SELECT = [
        'submit'    => 'Submit Dokumen',
        'proses'    => 'Menunggu Proses Akreditasi',
        'revisi'    => 'Revisi Dokumen',
        'terbit'    => 'Penerbitan SK dan Sertifikat',
        'pengajuan' => 'Pengajuan Akreditasi',
    ];

    protected $fillable = [
        'fakultas_id',
        'prodi_id',
        'jenjang_id',
        'lembaga_id',
        'type_ajuan',
        'note',
        'tgl_ajuan',
        'tgl_diterima',
        'status_ajuan',
        'diajukan_by_id',
        'clear',
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

    public function asesors()
    {
        return $this->belongsToMany(User::class);
    }

    public function getSuratTugasAttribute()
    {
        return $this->getMedia('surat_tugas');
    }

    public function getSuratPernyataanAttribute()
    {
        return $this->getMedia('surat_pernyataan');
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

    public function diajukan_by()
    {
        return $this->belongsTo(User::class, 'diajukan_by_id');
    }
}
