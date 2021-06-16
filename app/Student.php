<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\StudentClass;
class Student extends Model 
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'student_id';

    /**
     * 
     * Set table
     */
    protected $table = 'students';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

     /**
     * Appends attributes to object results.
     * 
     * @var array
     */
    protected $appends = [
        'student_class',
    ];

    /**
     * Set generate uuid value student_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->student_id = Helper::randString();
        });
    }

    protected function getStudentClassAttribute()
    {
        $dataStudentClass = StudentClass::where('student_class_id',$this->attributes['student_class_id'])->first();
        if($dataStudentClass){
            return $dataStudentClass->student_class_name;
        }
        return false;
    }
}
