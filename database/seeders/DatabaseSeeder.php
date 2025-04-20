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
        User::factory()->create([
            'name'  => 'Umer Farooq',
            'email' => 'umerfarooqkhan@325gmail.com',
        ]);
        User::factory()->create([
            'name'  => 'Ijaz Yetitech',
            'email' => 'ijaz@yetitech.com',
        ]);
        User::factory()->create([
            'name'  => 'Ahmad Arshad',
            'email' => 'ahmadArshad@gmail.com',
        ]);

        ExpenseCategory::factory(count: 17)->create();
    }//end run()


}//end class
