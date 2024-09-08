<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected function casts(): array
    {
        return [
            'created_at' => 'immutable_datetime:Y-m-d H:i:s',
            'updated_at' => 'immutable_datetime:Y-m-d H:i:s',
        ];
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
