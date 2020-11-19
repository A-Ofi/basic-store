<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use Exception;
use Helium\FakerJS\Server;

class DatabaseSeeder extends Seeder
{
    /**
     * attach items to each user's cart
     */
    private function attachToCart()
    {
        $nItems = Item::all()->count();
        foreach(User::all() as $user){
            $i = rand(5,8);// attach 5 to 8 items to each user
            while ($i !== 0){
                $item = Item::find(rand(2, $nItems - 1));
                if ($user->can('addToCart', $item)){
                    try{
                        $user->cart()->attach($item);
                    }catch(Exception $e){
                        continue;
                    }
                    $i--;
                }
            }
        }
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Server::checkRequiremnt() ? Server::start() : 0 ;
        
        
        User::factory()
        ->has(Item::factory()->count(rand(0,10)))
        ->count(30)->create();

        $this->attachToCart();
        

        Server::close();

            
    }
}
