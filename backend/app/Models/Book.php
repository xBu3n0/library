<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ["name", "price", "stock"];

    public function authors(): HasManyThrough
    {
        return $this->hasManyThrough(
            Author::class,
            BookAuthor::class,
            "book_id",
            "id",
            "id",
            "author_id"
        );
    }

    public function genres(): HasManyThrough
    {
        return $this->hasManyThrough(
            Genre::class,
            BookGenre::class,
            "book_id",
            "id",
            "id",
            "genre_id"
        );
    }
}
