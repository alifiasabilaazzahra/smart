<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_category extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_category_id';

    /**
     * 
     * Set table
     */
    protected $table = 'task_categories';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value task_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->task_category_id = Helper::randString();
            $model->created_at = \Carbon\Carbon::now();
        });
    }
}
