<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookGenre extends Model
{
    use HasFactory, HasUuids;

    protected $table = "books_genres";

    protected $fillable = ["genre_id", "book_id"];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
