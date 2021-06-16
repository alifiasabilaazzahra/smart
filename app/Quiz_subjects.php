<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Quiz_subjects extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'subject_id';

    /**
     * 
     * Set table
     */
    protected $table = 'subjects';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value subjects_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->subject_id = Helper::randString();
        });
    }
}
