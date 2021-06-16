<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_id';

    public $fillable = ['task_name','task_description'];
    /**
     * 
     * Set table
     */
    protected $table = 'tasks';
    
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
            $model->task_id = Helper::randString();
        });
    }
}
