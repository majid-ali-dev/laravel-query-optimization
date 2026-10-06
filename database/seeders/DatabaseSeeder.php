<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog();

        // ---------- Users ----------
        $this->command->info('Seeding 1,000 users...');

        $now = now();
        $users = [];

        for ($i = 0; $i < 1000; $i++) {
            $users[] = [
                'name'              => fake()->name(),
                'email'             => fake()->unique()->safeEmail(),
                'password'          => bcrypt('password'),
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];
        }

        User::insert($users); // 1 query

        $userIds = User::pluck('id')->toArray();

        // ---------- Posts ----------
        $this->command->info('Seeding 100,000 posts...');

        $bar = $this->command->getOutput()->createProgressBar(100000);
        $bar->start();

        $batch = [];
        $batchSize = 1000;

        for ($i = 0; $i < 100000; $i++) {
            $batch[] = [
                'user_id'     => $userIds[array_rand($userIds)],
                'title'       => fake()->sentence(6),
                'description' => fake()->paragraph(3),
                'created_at'  => now()->subDays(rand(0, 365)),
                'updated_at'  => now(),
            ];

            if (count($batch) === $batchSize) {
                Post::insert($batch);
                $bar->advance($batchSize);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            Post::insert($batch);
            $bar->advance(count($batch));
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('✅ Seeding completed.');
    }
}
