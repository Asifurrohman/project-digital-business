<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Gremyacip',
        //     'email' => 'akun.asifurrohman@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'admin'
        // ]);

        User::create([
            'name' => 'Gremyacip',
            'email' => 'akun.asifurrohman@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $category = Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $category2 = Category::create([
            'name' => 'Entertaiment',
            'slug' => 'entertaiment',
        ]);

        $category3 = Category::create([
            'name' => 'Sport',
            'slug' => 'sport',
        ]);

        Event::create([
            'category_id' => $category2->id,
            'title' => 'Jazz Night 2025',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
            'date' => '2026-05-10 19:00:00',
            'location' => 'Amikom Baru',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-1.png',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'Hackaton - Unleash Your Inner Developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
            'date' => '2026-05-05 10:00:00',
            'location' => 'Inkubator Amikom',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-2.png',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'AI & FUTURE TECH SUMMIT 2026',
            'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli di bidangnya.',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Cinema Unit 6',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-3.png',
        ]);

        Event::create([
            'category_id' => $category3->id,
            'title' => 'Uefa Champions League Final 2026',
            'description' => 'Final antara Bayern Munchen/PSG melawan Arsendal atau Atletico Madrid',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Si Jalak Harupat',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-3.png',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'Festival Qingming',
            'description' => 'Festival ziarah kuburan masing masing',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Kuburan Cina',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-3.png',
        ]);

        Event::create([
            'category_id' => $category2->id,
            'title' => 'Amikom Fun Run',
            'description' => 'Lari lari sekitar amikom ga jelas',
            'date' => '2026-05-01 13:00:00',
            'location' => 'Universitas Amikom Yogyakarta',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'posters/event-3.png',
        ]);
    }
}
