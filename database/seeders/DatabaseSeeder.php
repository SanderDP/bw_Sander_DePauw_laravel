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

        \App\Models\User::factory()->create([
            'name' => 'Sander',
            'email' => 'sander.de.pauw@student.ehb.be',
            'password' => bcrypt('Password!321'),
            'is_admin' => false,
            'birthday' => Carbon::now()->toDate(),
            'avatar' => '1F84AR9V6EAmOsdHG1EnHlaXmQAg9VEn9TgBfuJ3.jpg',
            'about_me' => 'Hier is een beetje informatie over mij!',
        ]);

        \App\Models\News::factory()->create([
            'title' => 'Nieuwsbericht 1',
            'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus vel est doloremque facere possimus nesciunt iure numquam iusto, laboriosam, eveniet dicta, temporibus nemo incidunt unde! Veritatis quae nobis quis minima!',
            'img_file_path' => 'uzQ2wsos8rCgYuMSAV6nR2IhIQimX9pWnqdzDrSR.png',
            'user_id' => 1
        ]);

        \App\Models\FAQCategories::factory()->create([
            'name' => 'Category 1',
        ]);

        \App\Models\FAQCategories::factory()->create([
            'name' => 'Category 2',
        ]);

        \App\Models\FAQuestions::factory()->create([
            'question' => 'What is the answer to question 1 of category 1?',
            'answer' => 'Here is the answer to this question.',
            'f_a_q_categories_id' => 1,
        ]);

        \App\Models\FAQuestions::factory()->create([
            'question' => 'What is the answer to question 2 of category 1?',
            'answer' => 'Here is the answer to this question.',
            'f_a_q_categories_id' => 1,
        ]);

        \App\Models\FAQuestions::factory()->create([
            'question' => 'What is the answer to question 1 of category 2?',
            'answer' => 'Here is the answer to this question.',
            'f_a_q_categories_id' => 2,
        ]);

        \App\Models\FAQuestions::factory()->create([
            'question' => 'What is the answer to question 2 of category 2?',
            'answer' => 'Here is the answer to this question.',
            'f_a_q_categories_id' => 2,
        ]);

        \App\Models\ContactForms::factory()->create([
            'name' => 'Sander',
            'mail' => 'sander.de.pauw@student.ehb.be',
            'message' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus vel est doloremque facere possimus nesciunt iure numquam iusto, laboriosam, eveniet dicta, temporibus nemo incidunt unde! Veritatis quae nobis quis minima!',
        ]);

        \App\Models\Orders::factory()->create([
            'user_id' => 1,
        ]);

        \App\Models\Products::factory()->create([
            'name' => 'Whole wheat bread',
            'img_file_path' => 'wholewheatbread.jpg',
            'price' => 1.50,
        ])->orders()->attach(1, ['amount' => 2]);

        \App\Models\Products::factory()->create([
            'name' => 'Baguette',
            'img_file_path' => 'baguette.jpg',
            'price' => 2.30,
        ])->orders()->attach(1, ['amount' => 1]);
    }
}
