<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;
use App\Models\Role;
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

        $users = [
            [
                'name' => 'Gremyacip',
                'email' => 'akun.asifurrohman@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'anu',
                'email' => 'anu@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'vendor'
            ],
            [
                'name' => 'fah',
                'email' => 'fah@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
        ];

        foreach($users as $user) {
            User::create($user);
        }

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
            'title' => 'Jazz Night 2027',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
            'date' => '2027-05-10 19:00:00',
            'location' => 'Novorossisk Hall',
            'price' => 50000,
            'stock' => 100,
            // 'poster_path' => 'assets/concert.png',
            'poster_path' => 'assets/concert.png',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'Hackaton - Unleash Your Inner Developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
            'date' => '2027-05-05 10:00:00',
            'location' => 'Bolshoi Theatre',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'assets/hackathon.png',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'AI & FUTURE TECH SUMMIT 2027',
            'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli di bidangnya.',
            'date' => '2027-05-01 13:00:00',
            'location' => 'Vladivostok Convention Center',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'assets/workshop.png',
        ]);

        Event::create([
            'category_id' => $category3->id,
            'title' => 'Uefa Champions League Final 2027',
            'description' => 'Final antara Bayern Munchen/PSG melawan Arsendal atau Atletico Madrid',
            'date' => '2027-05-01 13:00:00',
            'location' => 'Budapest Arena',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'assets/workshop.png',
        ]);

        Event::create([
            'category_id' => $category->id,
            'title' => 'Festival Qingming',
            'description' => 'Festival ziarah kuburan masing masing',
            'date' => '2027-05-01 13:00:00',
            'location' => 'Kuburan Cina',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'assets/workshop.png',
        ]);

        Event::create([
            'category_id' => $category2->id,
            'title' => 'Stile Fun Run',
            'description' => 'Lari lari sekitar Mandala Krida ga jelas',
            'date' => '2027-05-01 13:00:00',
            'location' => 'Mandala Krida',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'assets/concert.png',
        ]);

        Partner::create([
            'name' => 'Gaijin Entertainment',
            'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3c/Logo-gaijin.svg'
        ]);
    }
}
