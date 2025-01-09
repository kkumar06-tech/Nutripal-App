<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Food;
use Database\Seeders\FoodTableSeeder; 

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FoodControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function setUp() :void {
        parent::setUp();
        $user = new User(['name' => 'Thomas']);
        $this->be($user);
        $this->seed(FoodTableSeeder::class);
        }


    public function test_single_food_item(): void
    {
        $expected= '[{
            "id":1,"name":"Apple","meal_type":"breakfast","calories":95,"protein":0,"carbs":25,"fat":0,"portion":100
    }]';
        $expected1 = json_decode($expected, true); 
        $response = $this->get('api/foods/1');
        $response->assertOk()->assertJsonFragment($expected1[0]); //used JsonFragment as response include "created at" and "updated at"

    }

    public function test_all_food_items(): void
    {
        $response = $this->get('api/foods');
        $response->assertStatus(200);
    }


    public function test_update_item()
{

    $food = Food::create([
        'name' => 'Test',
        'meal_type'=>'dinner',
        'calories'=> 100,
        'protein'=> 100,
        'carbs'=> 5,
        'fat'=> 5,
        'portion'=> 100,
    ]);

    $response = $this->put("/api/foods/{$food->id}", [
        'name' => 'Orange',
    ]);
    $response->assertOk(); 
    $response->assertJson(['name' => 'Orange']); 
   
    $this->assertDatabaseHas('foods', [
        'id' => $food->id,
        'name' => 'Orange',
    ]);
}


public function test_storing_food()
{
    // Define the food data to send in the request
    $food=[
        'name' => 'Chilli  curry',
        'meal_type'=>'lunch',
        'calories' => 102,
        'protein' => 0,
        'carbs' => 40,
        'fat' => 5,
        'portion' => 100
    ];

    // Send a POST request to the store endpoint with the food data
    $response = $this->post('/api/foods', $food);

    // Assert the status code is 201 (created)
    $response->assertStatus(201);

 $response->assertJsonFragment($food);

 $this->assertDatabaseHas('foods', $food);

}

public function test_delete_item(){
   
    $food = Food::create([
        'name' => 'Test',
        'meal_type'=>'snack',
        'calories'=> 100,
        'protein'=> 100,
        'carbs'=> 5,
        'fat'=> 5,
        'portion'=> 100,
    ]);

    $response = $this->delete("/api/foods/{$food->id}");
    $response->assertJson(['message' => 'Food deleted successfully']);


}

}