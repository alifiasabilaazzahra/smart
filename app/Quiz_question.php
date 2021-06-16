<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_question extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'task_question_id';

    /**
     * 
     * Set table
     */
    protected $table = 'task_questions';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value question_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->task_question_id = Helper::randString();
        });
    }
}
