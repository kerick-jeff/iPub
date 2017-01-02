<?php

use Illuminate\Database\Seeder;

class LinkSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Link::class, 25)->create());
    }
}
