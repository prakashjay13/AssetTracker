<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Asset extends Model
{
    use HasFactory;
    
    public function categories(){
      
        return $this->belongsTo(Assettype::class);
    }
    public function images(){
        return $this->hasMany(Assetimage::class);
    }
}
