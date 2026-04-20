<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'id' => 1,
            'name' => 'Asep',
            'photo' => 'asep.jpg',
            'bio' => 'Genre dengan cerita yang imajinatif'

        ],
        [
            'id' => 2,
            'name' => 'Maya Sari',
            'photo' => 'maya.jpg',
            'bio' => 'Mengkhususkan diri pada cerita anak penuh pesan moral.'
        ],
        [
            'id' => 3,
            'name' => 'Dimas Nugroho',
            'photo' => 'dimas.jpg',
            'bio' => 'Penulis motivasi dan pengembangan diri.'
        ],
        [
            'id' => 4,
            'name' => 'Lestari Dewi',
            'photo' => 'lestari.jpg',
            'bio' => 'Novelis dengan tema spiritual dan filosofi.'
        ],
        [
            'id' => 5,
            'name' => 'Fajar Ramadhan',
            'photo' => 'fajar.jpg',
            'bio' => 'Penulis muda yang fokus pada fantasi dan petualangan.'
        ],
    ];

    public function getAuthors()
    {
        return $this->authors;
    }
}
