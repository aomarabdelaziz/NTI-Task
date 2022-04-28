<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'title' , 'content' , 'img_path' , 'start_date' , 'end_date' , 'user_id'];

    protected $appends = ['image_path'];

    public function user() : BelongsTo
    {
        return static::belongsTo(User::class);
    }

    public function imagePath() : Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset(Storage::url($this->img_path)),
        );
    }
}
