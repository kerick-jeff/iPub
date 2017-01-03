<?php

use Illuminate\Database\Seeder;

class PubSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pub::class, 25)->create());
    }
}
