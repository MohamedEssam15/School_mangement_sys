<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class grade extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $fillable=['Name','Notes'];
    public $translatable = ['Name'];

    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'Grade_id');
    }
}
