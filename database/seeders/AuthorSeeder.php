<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Asep',
            'photo' => 'asep.jpg',
            'bio' => 'Penulis jalanan yang mengangkat kisah-kisah inspiratif dari kehidupan sehari-hari.'
        ]);
        Author::create([
            'name' => 'Maya Sari',
            'photo' => 'maya.jpg',
            'bio' => 'Mengkhususkan diri pada cerita anak penuh pesan moral.'
        ]);
        Author::create([
            'name' => 'Dimas Nugroho',
            'photo' => 'dimas.jpg',
            'bio' => 'Penulis motivasi dan pengembangan diri.'
        ]);
        Author::create([
            'name' => 'Lestari Dewi',
            'photo' => 'lestari.jpg',
            'bio' => 'Novelis dengan tema spiritual dan filosofi.'
        ]);
        Author::create([
            'name' => 'Fajar Ramadhan',
            'photo' => 'fajar.jpg',
            'bio' => 'Penulis muda yang fokus pada fantasi dan petualangan.'
        ]);
    }
}
