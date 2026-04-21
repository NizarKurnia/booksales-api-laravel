<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Turu',
            'description' => 'Perjuangan sang protagonis untuk mencari cara agar bisa tidur nyenyak',
            'price' => 50.000,
            'stock' => 2,
            'cover_photo' => 'turu.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ]);
        Book::create([
            'title' => 'Bangun',
            'description' => 'Kisah seseorang yang berusaha bangun dari dunia mimpi yang indah',
            'price' => 60.000,
            'stock' => 3,
            'cover_photo' => 'bangun.jpg',
            'genre_id' => 2,
            'author_id' => 2,
        ]);
        Book::create([
            'title' => 'Hidup',
            'description' => 'Kehidupan seorang manusia yang bertahan hidup demi mencari ketenangan',
            'price' => 70.000,
            'stock' => 5,
            'cover_photo' => 'hidup.jpg',
            'genre_id' => 3,
            'author_id' => 3,
        ]);
        Book::create([
            'title' => 'Dunia Fantasi',
            'description' => 'Petualangan epik di dunia penuh sihir dan makhluk mistis',
            'price' => 90000,
            'stock' => 4,
            'cover_photo' => 'fantasi.jpg',
            'genre_id' => 3,
            'author_id' => 4,
        ]);
        Book::create([
            'title' => 'Bangkit',
            'description' => 'Buku motivasi untuk membangun semangat dan percaya diri',
            'price' => 55000,
            'stock' => 6,
            'cover_photo' => 'bangkit.jpg',
            'genre_id' => 5,
            'author_id' => 5,
        ]);
    }
}
