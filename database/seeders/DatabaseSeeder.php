<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create();

        Status::factory()
            ->count(3)
            ->sequence(
                ['name' => 'pending'],
                ['name' => 'success'],
                ['name' => 'failed'],
            )
            ->create();
    }
}
