<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['bookName', 'category_id', 'author_id', 'averageRating', 'voters'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function calculateAverageRating()
    {
        $totalRatings = $this->ratings()->count();

        if ($totalRatings > 0) {
            $sumRatings = $this->ratings()->sum('rating');
            $averageRating = $sumRatings / $totalRatings;

            $this->update(['averageRating' => $averageRating, 'voters' => $totalRatings]);
        }
    }
}
