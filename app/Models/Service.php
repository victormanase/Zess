<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "description"
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes["price"] = str_replace([","], [""], $value);
    }
}
