<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\User;

use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Create default admin user
        User::factory()->create([
            'name'  => 'Umer Farooq',
            'email' => 'umerfarooqkhan325@gmail.com',
        ]);

        // Create additional test users
        User::factory()->create([
            'name'  => 'Ijaz Yetitech',
            'email' => 'ijaz@yetitech.com',
        ]);
        User::factory()->create([
            'name'  => 'Ahmad Arshad',
            'email' => 'ahmadArshad@gmail.com',
        ]);

        // Create default expense categories for the first user
        ExpenseCategory::factory(count: 17)->create();
    }//end run()


}//end class