<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Month extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'months';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'year_id',
        'name',
        'number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
}