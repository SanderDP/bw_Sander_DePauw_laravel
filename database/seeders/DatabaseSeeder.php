<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use DateTime;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => bcrypt('Password!321'),
            'is_admin' => true,
            'birthday' => Carbon::now()->toDate(),
            'avatar' => 'uzQ2wsos8rCgYuMSAV6nR2IhIQimX9pWnqdzDrSR.png',
            'about_me' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus vel est doloremque facere possimus nesciunt iure numquam iusto, laboriosam, eveniet dicta, temporibus nemo incidunt unde! Veritatis quae nobis quis minima!',
        ]);

        \App\Models\News::factory()->create([
            'title' => 'Nieuwsbericht 1',
            'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus vel est doloremque facere possimus nesciunt iure numquam iusto, laboriosam, eveniet dicta, temporibus nemo incidunt unde! Veritatis quae nobis quis minima!',
            'img_file_path' => 'uzQ2wsos8rCgYuMSAV6nR2IhIQimX9pWnqdzDrSR.png',
            'user_id' => 1
        ]);
    }
}
