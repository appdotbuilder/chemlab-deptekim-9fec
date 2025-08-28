<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lab>
 */
class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Lab Operasi Teknik Kimia',
            'Lab Analisis Instrumen',
            'Lab Termodinamika',
            'Lab Pengolahan Limbah'
        ];
        
        $name = fake()->randomElement($names);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'location' => fake()->randomElement([
                'Gedung Teknik Kimia Lantai 1',
                'Gedung Teknik Kimia Lantai 2',
                'Gedung Teknik Kimia Lantai 3',
                'Gedung Baru Teknik Lantai 4'
            ]),
            'capacity' => fake()->numberBetween(15, 40),
            'operational_hours' => [
                'monday' => ['start' => '08:00', 'end' => '17:00'],
                'tuesday' => ['start' => '08:00', 'end' => '17:00'],
                'wednesday' => ['start' => '08:00', 'end' => '17:00'],
                'thursday' => ['start' => '08:00', 'end' => '17:00'],
                'friday' => ['start' => '08:00', 'end' => '16:00'],
                'saturday' => ['start' => '08:00', 'end' => '12:00'],
                'sunday' => null
            ],
            'description' => fake()->paragraph(3),
            'contact_email' => fake()->email(),
            'contact_phone' => fake()->phoneNumber(),
            'gallery_images' => [
                '/images/labs/lab1.jpg',
                '/images/labs/lab2.jpg'
            ],
            'sop_document_path' => '/documents/sop_' . Str::slug($name) . '.pdf',
            'sds_links' => [
                'https://example.com/sds1',
                'https://example.com/sds2'
            ],
            'is_active' => true,
        ];
    }
}