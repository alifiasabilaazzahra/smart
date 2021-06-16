<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Theory extends Model
{
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'theory_id';

    public $fillable = ['theory_name','theory_description'];
    /**
     * 
     * Set table
     */
    protected $table = 'theories';
    
    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Set generate uuid value theory_category_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->theory_id = Helper::randString();
        });
    }
}
