<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Lab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $equipmentNames = [
            'Spektrofotometer UV-Vis',
            'HPLC System',
            'Gas Chromatography',
            'pH Meter Digital',
            'Magnetic Stirrer',
            'Rotary Evaporator',
            'Vacuum Pump',
            'Distillation Column',
            'Heat Exchanger',
            'Centrifuge',
            'Analytical Balance',
            'Furnace',
            'Safety Shower',
            'Eyewash Station',
            'Fume Hood'
        ];

        $manufacturers = ['Agilent', 'Shimadzu', 'Thermo Fisher', 'Waters', 'Mettler Toledo', 'Hach', 'Cole-Parmer'];
        
        $name = fake()->randomElement($equipmentNames);
        
        return [
            'name' => $name,
            'asset_code' => 'EQ' . fake()->unique()->numerify('####'),
            'category_id' => Category::factory(),
            'lab_id' => Lab::factory(),
            'description' => fake()->sentence(10),
            'technical_specifications' => [
                'power' => fake()->randomElement(['220V', '110V', 'Battery']),
                'weight' => fake()->randomFloat(2, 1, 100) . ' kg',
                'dimensions' => fake()->randomFloat(1, 10, 100) . 'x' . fake()->randomFloat(1, 10, 100) . 'x' . fake()->randomFloat(1, 10, 100) . ' cm',
                'accuracy' => fake()->randomElement(['±0.1%', '±0.5%', '±1%']),
                'range' => fake()->randomElement(['0-100°C', '0-1000 ppm', '0-14 pH']),
            ],
            'manufacturer' => fake()->randomElement($manufacturers),
            'model' => fake()->bothify('Model-##??'),
            'serial_number' => fake()->bothify('SN###????'),
            'year_acquired' => fake()->numberBetween(2018, 2024),
            'condition' => fake()->randomElement(['excellent', 'good', 'fair']),
            'availability_status' => fake()->randomElement(['available', 'borrowed', 'maintenance']),
            'calibration_schedule' => [
                'last_calibration' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'next_calibration' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'frequency' => fake()->randomElement(['monthly', 'quarterly', 'semi-annual', 'annual'])
            ],
            'risk_assessment' => fake()->randomElement([
                'Low risk - Standard precautions required',
                'Medium risk - PPE and ventilation required',
                'High risk - Special training and supervision required'
            ]),
            'required_ppe' => [
                fake()->randomElement(['Safety glasses', 'Goggles']),
                fake()->randomElement(['Lab coat', 'Apron']),
                fake()->randomElement(['Gloves', 'Heat-resistant gloves']),
            ],
            'sds_links' => [
                'https://example.com/sds/' . strtolower(str_replace(' ', '-', $name)) . '.pdf'
            ],
            'images' => [
                '/images/equipment/equipment1.jpg',
                '/images/equipment/equipment2.jpg'
            ],
            'qr_code_path' => '/qr-codes/equipment-' . fake()->unique()->numerify('####') . '.png',
            'is_active' => true,
        ];
    }
}