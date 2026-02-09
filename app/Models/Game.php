<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'developer',
        'publisher',
        'release_year',
        'genre_id',
        'cover',
        'description'
    ];

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function scopePopular($query) {
        return $query->whereHas('reviews', function($query) {
            $query->where('score', '>=', '8');
        });
    }

    public function scopeFilter($query, $filter) {
        $query->when($filter['synopsis'] ?? false, function($query, $synopsis) {
            $query->where('synopsis', 'LIKE', str_replace('*', '%', $synopsis));
        })
        ->when($filter['developer'] ?? false, function($query, $developer){
            $query->where('developer', 'LIKE', str_replace('*', '%', $developer));
        })
        ->when($filter['publisher'] ?? false, function($query, $publisher){
            $query->where('publisher', 'LIKE', str_replace('*', '%', $publisher));
        })
        ->when($filter['release_year'] ?? false, function($query, $release_year){

            if (str_contains($release_year, '-') && str_contains($release_year, ',')) {
                abort(400, 'No es posible combinar rangos y listas');
            }

            $query->when(str_contains($release_year, '-'), function($query) use ($release_year) {
                $years = sort(explode('-', $release_year));
                $query->whereBetween('release_year', [$years[0], $years[1]]);
            })
            ->when(str_contains($release_year, ','), function($query) use ($release_year) {
                $query->whereIn('release_year', explode(',', $release_year));
            });
        });

        return $query;
    }
}
