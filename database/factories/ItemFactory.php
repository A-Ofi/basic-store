<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Helium\FakerJS\Server;

class ItemFactory extends Factory
{

    private $fromServer = false;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    private function fakeName()
    {
        return $this->fromServer ? 
            file_get_contents(Server::URL()."/item/name")
            :
            $this->faker->sentence(5);
    }
    private function fakeDescription()
    {
        return $this->fromServer ?
            file_get_contents(Server::URL()."/item/description")
            :
            $this->faker->sentences(4, true);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->fromServer = Server::$running;
        return [
            'name' => $this->fakeName(),
            'description' => $this->fakeDescription(),
            'price' => $this->faker->numberBetween(1, pow(10, 6)),
            'city' => $this->faker->city
        ];
    }
}
