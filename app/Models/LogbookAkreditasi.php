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

class LogbookAkreditasi extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'logbook_akreditasis';

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->ulid = (string) Ulid::generate();
        });
    }

    protected $appends = [
        'hasil_pekerjaan',
    ];

    protected $dates = [
        'tanggal',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TUGAS_SELECT = [
        'spmi' => 'SPMI',
        'spme' => 'SPME',
        'gkm'  => 'GKM',
    ];

    protected $fillable = [
        'user_id',
        'tugas',
        'uraian_id',
        'detail',
        'tanggal',
        'jumlah',
        'satuan',
        'keterangan',
        'valid',
        'validated_by_id',
        'paid',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function uraian()
    {
        return $this->belongsTo(UraianLogbook::class, 'uraian_id');
    }

    public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHasilPekerjaanAttribute()
    {
        return $this->getMedia('hasil_pekerjaan');
    }

    public function validated_by()
    {
        return $this->belongsTo(User::class, 'validated_by_id');
    }
}
