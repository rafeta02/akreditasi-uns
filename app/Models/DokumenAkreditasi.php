<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DokumenAkreditasi extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    protected $appends = [
        'file',
    ];

    public $table = 'dokumen_akreditasis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'led'  => 'LED',
        'isk'  => 'ISK',
        'dkps' => 'DKPS',
        'lksp' => 'LKPS',
    ];

    protected $fillable = [
        'ajuan_id',
        'name',
        'type',
        'note',
        'counter',
        'owned_by_id',
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

    public function ajuan()
    {
        return $this->belongsTo(Ajuan::class, 'ajuan_id');
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();
    }

    public function owned_by()
    {
        return $this->belongsTo(User::class, 'owned_by_id');
    }
}
