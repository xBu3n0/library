<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserWhitelist extends Model
{
    use HasFactory, HasUuids;

    protected $table = "users_whitelists";

    public function book(): HasOne
    {
        return $this->hasOne(Book::class, "id", "book_id");
    }
}
