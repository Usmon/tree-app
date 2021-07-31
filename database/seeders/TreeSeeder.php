<?php

namespace Database\Seeders;

use App\Models\Tree;
use Illuminate\Database\Seeder;

class TreeSeeder extends Seeder
{
    /**
     * @var int
     */
    private $limit = 500;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        while ($this->limit--)
            Tree::factory()
                  ->create();
    }
}
