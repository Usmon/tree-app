<?php

namespace Database\Factories;

use App\Models\Tree;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tree::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $item = $this->getRandomItem();

        return [
            'parent_id' => $item,
            'position' => $this->getPosition($item),
            'text' => $this->faker->text(20)
        ];
    }

    /**
     * @return Tree|null
     */
    private function getRandomItem()
    {
        $items = Tree::all();

        return $items->isNotEmpty() ? $items->random() : null;
    }

    /**
     * @param $item
     *
     * @return int
     */
    public function getPosition($item): int
    {
        return $item ? $item->child_count + 1 : 1;
    }
}
