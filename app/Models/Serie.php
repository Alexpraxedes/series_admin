<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use SoftDeletes, HasFactory, HasPrimaryKeyUuid;

    public function getKey(): string
    {
        return 'uuid';
    }

    public function getKeyName(): string
    {
        return 'uuid';
    }
}
