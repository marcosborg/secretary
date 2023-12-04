<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'students';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const GENDER_RADIO = [
        'male'   => 'Homem',
        'female' => 'Mulher',
    ];

    public const RESPONSIBILITY_RADIO = [
        'publisher'           => 'Publicador',
        'pioneer'             => 'Pioneiro',
        'ministerial_servant' => 'Servo ministerial',
        'elder'               => 'Ancião',
    ];

    protected $fillable = [
        'name',
        'gender',
        'responsibility',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function life_ministry_events()
    {
        return $this->hasMany(LifeMinistryEvent::class);
    }
}
