<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class LembagaAkreditasi extends Model
{
    use SoftDeletes, Auditable, HasFactory, Sluggable;

    public $table = 'lembaga_akreditasis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'nasional'      => 'Nasional',
        'internasional' => 'Internasional',
    ];

    protected $fillable = [
        'code',
        'name',
        'slug',
        'type',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name'],
                'separator' => '-', // Custom separator
                'maxLength' => 50, // Maximum length of the slug
            ]
        ];
    }
}
