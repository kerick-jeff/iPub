<?php

use Illuminate\Database\Seeder;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 25)->create()->each(function($u) {
            $u->notifications()->save(factory(App\Notification::class)->make());
            $u->links()->save(factory(App\Link::class)->make());
            $u->subscriptions()->save(factory(App\Subscription::class)->make());
            $u->pubs()-save(factory(App\Pub::class)->make());
        });
    }
}
