<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_schedule extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_schedule_id';

    /**
     * 
     * Set table
     */
    protected $table = 'task_schedules';
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value schedule_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->task_schedule_id = Helper::randString();
        });
    }

}
