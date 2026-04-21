<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'Fiksi',
            'description' => 'Cerita imajinatif yang tidak berdasarkan kejadian nyata.'
        ]);

        Genre::create([
            'name' => 'Non-Fiksi',
            'description' => 'Buku yang berisi fakta, informasi, dan pengetahuan nyata.'
        ]);

        Genre::create([
            'name' => 'Fantasi',
            'description' => 'Genre dengan elemen magis, dunia imajinatif, dan petualangan.'
        ]);

        Genre::create([
            'name' => 'Romansa',
            'description' => 'Cerita yang berfokus pada hubungan percintaan.'
        ]);

        Genre::create([
            'name' => 'Motivasi',
            'description' => 'Buku yang memberikan inspirasi dan dorongan semangat.'
        ]);
    }
}
