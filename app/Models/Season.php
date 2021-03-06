<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Collections\EpisodeCollection;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['data'];

    public function episodes()
    {
        return $this->hasMany( Episode::class );
    }

    public function serie()
    {
        return $this->belongsTo( Serie::class );
    }

    public function newCollection( $models = []){
        return new EpisodeCollection($models);
    }
}
