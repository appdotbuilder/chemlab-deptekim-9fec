<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Glassware', 'color' => '#3B82F6', 'description' => 'Peralatan gelas laboratorium'],
            ['name' => 'Analytical Instruments', 'color' => '#10B981', 'description' => 'Instrumen analisis dan pengukuran'],
            ['name' => 'Reactors', 'color' => '#F59E0B', 'description' => 'Reaktor dan vessel'],
            ['name' => 'Pumps', 'color' => '#EF4444', 'description' => 'Pompa dan sistem sirkulasi'],
            ['name' => 'Sensors', 'color' => '#8B5CF6', 'description' => 'Sensor dan alat monitoring'],
            ['name' => 'Safety Equipment', 'color' => '#059669', 'description' => 'Peralatan keselamatan kerja'],
        ];
        
        $category = fake()->randomElement($categories);
        
        return [
            'name' => $category['name'],
            'slug' => Str::slug($category['name']),
            'description' => $category['description'],
            'color' => $category['color'],
        ];
    }
}