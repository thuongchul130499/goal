<?php

use App\FollowUser;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main = App\User::first();
        factory(App\User::class, 50)->create()->each(function ($user) use($main) {
            FollowUser::create([
                'following_id' => $main->id,
                'follower_id' => $user->id,
            ]);
            FollowUser::create([
                'follower_id' => $main->id,
                'following_id' => $user->id,
            ]);
        });
    }
}
