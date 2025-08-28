<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Glassware',
                'slug' => 'glassware',
                'description' => 'Peralatan gelas laboratorium seperti beaker, erlenmeyer, pipet, dan burette',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Analytical Instruments',
                'slug' => 'analytical-instruments',
                'description' => 'Instrumen analisis dan pengukuran seperti spektrofotometer, HPLC, GC',
                'color' => '#10B981',
            ],
            [
                'name' => 'Reactors',
                'slug' => 'reactors',
                'description' => 'Reaktor dan vessel untuk proses kimia',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Pumps',
                'slug' => 'pumps',
                'description' => 'Pompa dan sistem sirkulasi fluida',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Sensors',
                'slug' => 'sensors',
                'description' => 'Sensor dan alat monitoring seperti pH meter, termometer digital',
                'color' => '#8B5CF6',
            ],
            [
                'name' => 'Safety Equipment',
                'slug' => 'safety-equipment',
                'description' => 'Peralatan keselamatan kerja seperti safety shower, eyewash, fume hood',
                'color' => '#059669',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}