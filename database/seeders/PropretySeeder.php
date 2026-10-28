<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proprety;
use App\Models\Category;
use App\Models\ListingType;
use App\Models\User;
use App\Models\PropretyImage;

class PropretySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();
        $listingTypes = ListingType::all();

        $properties = [
            [
                'name' => 'Luxury Villa in Downtown',
                'city' => 'Paris',
                'address' => '123 Rue de la Paix',
                'price' => 1250000,
                'size' => 350,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'description' => 'Beautiful luxury villa with modern amenities, swimming pool, and garden. Located in the heart of Paris.',
            ],
            [
                'name' => 'Modern Apartment with View',
                'city' => 'Lyon',
                'address' => '45 Boulevard de la République',
                'price' => 450000,
                'size' => 120,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'description' => 'Modern apartment with stunning city view, fully furnished, near public transport.',
            ],
            [
                'name' => 'Cozy Family Home',
                'city' => 'Marseille',
                'address' => '78 Avenue du Prado',
                'price' => 320000,
                'size' => 150,
                'bedrooms' => 4,
                'bathrooms' => 2,
                'description' => 'Perfect family home with spacious rooms, backyard, and close to schools.',
            ],
            [
                'name' => 'Commercial Office Space',
                'city' => 'Paris',
                'address' => '200 Avenue des Champs-Élysées',
                'price' => 2500,
                'size' => 500,
                'bedrooms' => 0,
                'bathrooms' => 2,
                'description' => 'Modern office space in prime location, fully equipped for business operations.',
            ],
            [
                'name' => 'Charming Townhouse',
                'city' => 'Bordeaux',
                'address' => '15 Rue Sainte-Catherine',
                'price' => 580000,
                'size' => 200,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'description' => 'Historic townhouse with character, renovated with modern comforts.',
            ],
            [
                'name' => 'Penthouse Suite',
                'city' => 'Nice',
                'address' => '33 Promenade des Anglais',
                'price' => 890000,
                'size' => 180,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'description' => 'Luxurious penthouse with panoramic sea view, terrace, and premium finishes.',
            ],
            [
                'name' => 'Novotel Bordeaux Centre',
                'city' => 'Bordeaux',
                'address' => '7 Cours de l\'Intendance',
                'price' => 180,
                'size' => 25,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'description' => 'Le Novotel Bordeaux Centre est un hôtel 4 étoiles situé en plein cœur de Bordeaux, à quelques minutes de la place de la Bourse et du Miroir d\'eau. Cet hôtel moderne propose des chambres spacieuses et confortables, toutes équipées d\'un bureau, d\'une télévision à écran plat, d\'un minibar et d\'une salle de bain privative avec sèche-cheveux. Les clients peuvent profiter du petit-déjeuner buffet chaque matin, du restaurant sur place qui sert une cuisine française et internationale, ainsi que du bar pour se détendre en fin de journée. L\'hôtel dispose également d\'une piscine intérieure chauffée, d\'un centre de fitness et d\'un sauna pour les moments de détente. Le personnel multilingue est disponible 24h/24 pour répondre à toutes les demandes. Wi-Fi gratuit dans tout l\'établissement, parking privé payant sur place, chambres familiales disponibles, installations pour personnes à mobilité réduite. Idéal pour les voyages d\'affaires et les séjours touristiques.',
            ],
        ];

        foreach ($properties as $index => $propertyData) {
            $property = Proprety::create([
                'name' => $propertyData['name'],
                'city' => $propertyData['city'],
                'address' => $propertyData['address'],
                'price' => $propertyData['price'],
                'size' => $propertyData['size'],
                'bedrooms' => $propertyData['bedrooms'],
                'bathrooms' => $propertyData['bathrooms'],
                'description' => $propertyData['description'],
                'category_id' => $categories[$index % $categories->count()]->id,
                'listing_type_id' => $listingTypes[$index % $listingTypes->count()]->id,
                'user_id' => $users[$index % $users->count()]->id,
            ]);

            // Add dummy image path (since we can't actually upload images in seeder)
            PropretyImage::create([
                'property_id' => $property->id,
                'image_path' => 'property_' . ($index + 1) . '.jpg',
            ]);
        }

        $this->command->info('Propriétés de test créées avec succès !');
    }
}
