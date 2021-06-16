<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_question_option extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_question_option_id';

    /**
     * 
     * Set table
     */
    protected $table = 'task_question_options';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value option_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->task_question_option_id = Helper::randString();
        });
    }
}
