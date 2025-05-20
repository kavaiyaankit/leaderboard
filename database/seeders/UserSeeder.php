<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Activity;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(3)
            ->create()
            ->each(fn ($user) => $this->createActivitiesForUser($user));
    }

    private function createActivitiesForUser(User $user): void
    {
        $activities = collect(range(1, rand(1, 3)))->map(function () use ($user) {
            return [
                'user_id' => $user->id,
                'performed_at' => $this->generateRandomTimestamp(),
                'points' => 20,
                'name' => $this->generateRandomActivityName(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        Activity::insert($activities->toArray()); 
    }

    private function generateRandomActivityName(): string
    {
        return collect([
            'Running', 'Cycling', 'Swimming', 'Reading', 'Writing',
            'Cooking', 'Gaming', 'Shopping', 'Painting', 'Jogging'
        ])->random();
    }

    private function generateRandomTimestamp(): Carbon
    {
        return now()
            ->subDays(rand(0, 60))
            ->subHours(rand(0, 23))
            ->subMinutes(rand(0, 59));
    }
}