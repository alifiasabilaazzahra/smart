<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\TeacherSubject;
class Teacher extends Model 
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'teacher_id';

    /**
     * 
     * Set table
     */
    protected $table = 'teachers';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value teacher_id.
     *
     */
    protected $appends = ['subjects'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->teacher_id = Helper::randString();
        });
    }    

    protected function getSubjectsAttribute()
    {
        return TeacherSubject::select('subjects.subject_id', 'subjects.subject_name')->join('subjects', 'subjects.subject_id', '=', 'teacher_subjects.subject_id')
                                    ->where('teacher_id', $this->attributes['teacher_id'])
                                    ->get();
    }
}
