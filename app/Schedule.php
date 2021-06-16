<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Teacher;
use App\StudentClass;
use App\Quiz_subjects;
class Schedule extends Model 
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'schedule_id';

    /**
     * 
     * Set table
     */
    protected $table = 'schedules';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value teacher_id.
     *
     */
    protected $appends = ['teachers','student_classes', 'subjects'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->schedule_id = Helper::randString();
        });
    }    

    protected function getTeachersAttribute()
    {
        return Teacher::where('teacher_id', $this->attributes['teacher_id'])->first();
    }

    protected function getStudentClassesAttribute()
    {
        return StudentClass::where('student_class_id', $this->attributes['student_class_id'])->first();
    }

    protected function getSubjectsAttribute()
    {
        return Quiz_subjects::where('subject_id', $this->attributes['subject_id'])->first();
    }

}
