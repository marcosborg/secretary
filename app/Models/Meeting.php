<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Auditable;

class Meeting extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Auditable;

    public const MEETING_RADIO = [
        '1' => 'Meio de semana',
        '2' => 'Fim de semana',
    ];

    public const WEEK_RADIO = [
        '1' => 'Primeira semana',
        '2' => 'Segunda semana',
        '3' => 'Terceira semana',
        '4' => 'Quarta semana',
        '5' => 'Quinta semana',
    ];

    public $table = 'meetings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'month_id',
        'week',
        'meeting',
        'presences',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
