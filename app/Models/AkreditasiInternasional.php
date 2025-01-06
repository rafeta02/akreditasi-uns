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
use Illuminate\Database\Eloquent\Builder;

class AkreditasiInternasional extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'akreditasi_internasionals';

    protected $appends = [
        'sertifikat',
        'file_penunjang',
    ];

    protected $dates = [
        'tgl_sk',
        'tgl_awal_sk',
        'tgl_akhir_sk',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PERINGKAT_SELECT = [
        'UNGGUL'      => 'UNGGUL',
        'BAIK SEKALI' => 'BAIK SEKALI',
        'BAIK'        => 'BAIK',
        'A'           => 'A',
        'B'           => 'B',
        'C'           => 'C',
    ];

    protected $fillable = [
        'fakultas_id',
        'prodi_id',
        'jenjang_id',
        'lembaga_id',
        'no_sk',
        'tgl_sk',
        'tgl_awal_sk',
        'tgl_akhir_sk',
        'tahun_expired',
        'peringkat',
        'nilai',
        'diakui_dikti',
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

    public function getTglSkAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglSkAttribute($value)
    {
        $this->attributes['tgl_sk'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTglAwalSkAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglAwalSkAttribute($value)
    {
        $this->attributes['tgl_awal_sk'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getTglAkhirSkAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglAkhirSkAttribute($value)
    {
        $this->attributes['tgl_akhir_sk'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSertifikatAttribute()
    {
        $file = $this->getMedia('sertifikat')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getFilePenunjangAttribute()
    {
        return $this->getMedia('file_penunjang');
    }

    public function scopeCurrent(Builder $query)
    {
        return $query->whereDate('tgl_awal_sk', '<=', Carbon::today())
                     ->whereDate('tgl_akhir_sk', '>=', Carbon::today());
    }

    public function scopeAllAkreditasi(Builder $query, $prodi)
    {
        return $query->where('prodi_id', $prodi)->orderBy('tgl_akhir_sk', 'desc');
    }
}
