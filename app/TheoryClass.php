<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class TheoryClass extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'theory_class_id';
    /**
     * 
     * Set table
     */
    protected $table = 'theory_classes';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value theory_class_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->theory_class_id = Helper::randString();
        });
    }
}
