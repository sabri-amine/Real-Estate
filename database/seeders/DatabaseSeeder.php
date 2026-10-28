<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\ListingType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PropretySeeder::class,
        ]);

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        $categories = ['Apartment', 'Villa', 'Home', 'Office', 'Building', 'Townhouse'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        $listingTypes = ['For Rent', 'For Sale'];
        foreach ($listingTypes as $type) {
            ListingType::firstOrCreate(['name' => $type]);
        }
    }
}
