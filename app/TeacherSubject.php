<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
class TeacherSubject extends Model 
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'teacher_subject_id';

    /**
     * 
     * Set table
     */
    protected $table = 'teacher_subjects';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value teacher_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->teacher_subject_id = Helper::randString();
        });
    }    
}
