<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeederTable::class);
        $this->call(LinkSeederTable::class);
        $this->call(PubSeederTable::class);
        $this->call(NotificationSeederTable::class);
        $this->call(SubscriptionSeederTable::class);
    }
}
