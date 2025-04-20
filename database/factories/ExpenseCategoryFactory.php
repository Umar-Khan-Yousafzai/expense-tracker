<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpenseCategory>
 */
class ExpenseCategoryFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition(): array
     {
         $categoryNames = ['Drinks', 'Food', 'Dinner', 'Hangout', 'Transport', 'Snacks', 'Shopping','Breakfast', 'Lunch', 'Dinner', 'Groceries', 'Utilities', 'Rent', 'Entertainment', 'Travel', 'Health', 'Education', 'Miscellaneous'];
         $name = $this->faker->unique()->randomElement($categoryNames);

         return [
             'name' => $name,
             'description' => $this->faker->sentence(),
             'user_id' => 1 // Make sure you have users first
         ];
     }



}//end class
