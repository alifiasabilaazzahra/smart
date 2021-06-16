<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_point extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_point_id';

    /**
     * 
     * Set table
     */
    protected $table = 'task_points';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value point_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->task_point_id = Helper::randString();
        });
    }
}
