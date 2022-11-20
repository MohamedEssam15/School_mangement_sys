<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class classroom extends Model
{
    use HasFactory,HasTranslations;
    protected $fillable=['Name_Class','Grade_id'];
    public $translatable = ['Name_Class'];



    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }
}
