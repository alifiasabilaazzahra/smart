<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class StudentClass extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'student_class_id';

    /**
     * 
     * Set table
     */
    protected $table = 'student_classes';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value student_class_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->student_class_id = Helper::randString();
            $model->created_at = \Carbon\Carbon::now();
        });
    }
}
