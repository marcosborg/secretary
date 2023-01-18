<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class Report extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Auditable;

    public $table = 'reports';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'month_id',
        'publisher_id',
        'publications',
        'videos',
        'hours',
        'revisits',
        'studies',
        'pioneer',
        'observations',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
