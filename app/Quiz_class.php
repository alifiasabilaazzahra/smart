<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_class extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_class_id';

    /**
     * 
     * Set table
     */
    protected $table = 'task_classes';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value class_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->task_id = Helper::randString();
        });
    }
}
