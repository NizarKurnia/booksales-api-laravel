<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'id' => 1,
            'name' => 'Fiksi',
            'description' => 'Cerita imajinatif yang tidak berdasarkan kejadian nyata.'
        ],
        [
            'id' => 2,
            'name' => 'Non-Fiksi',
            'description' => 'Buku yang berisi fakta, informasi, dan pengetahuan nyata.'
        ],
        [
            'id' => 3,
            'name' => 'Fantasi',
            'description' => 'Genre dengan elemen magis, dunia imajinatif, dan petualangan.'
        ],
        [
            'id' => 4,
            'name' => 'Romansa',
            'description' => 'Cerita yang berfokus pada hubungan percintaan.'
        ],
        [
            'id' => 5,
            'name' => 'Motivasi',
            'description' => 'Buku yang memberikan inspirasi dan dorongan semangat.'
        ],
    ];

    public function getGenres()
    {
        return $this->genres;
    }
}
