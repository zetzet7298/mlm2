<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call([
            UsersSeeder::class,
            // CategoriesTableSeeder::class,
            // TagsTableSeeder::class,
            // CouponsTableSeeder::class,
            // ProductsTableSeeder::class,
            // ProductTagSeeder::class,

            // PermissionsSeeder::class,
            // RolesSeeder::class,
        ]);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ProductTagSeeder::class);
    }
}
