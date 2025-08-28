<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lab;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\LandingPageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed basic data first
        $this->call([
            LabSeeder::class,
            CategorySeeder::class,
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@che.ui.ac.id',
            'password' => Hash::make('Admin1234'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create example users for each lab
        $labs = Lab::all();
        
        foreach ($labs as $index => $lab) {
            // Create Kepala Lab
            User::create([
                'name' => 'Dr. Kepala Lab ' . ($index + 1),
                'email' => 'kepala.lab' . ($index + 1) . '@che.ui.ac.id',
                'password' => Hash::make('Kepala1234'),
                'status' => 'active',
                'lab_id' => $lab->id,
                'email_verified_at' => now(),
            ]);

            // Create Laboran
            User::create([
                'name' => 'Laboran ' . $lab->name,
                'email' => 'laboran' . ($index + 1) . '@che.ui.ac.id',
                'password' => Hash::make('Laboran1234'),
                'status' => 'active',
                'lab_id' => $lab->id,
                'email_verified_at' => now(),
            ]);
        }

        // Create Dosen
        User::create([
            'name' => 'Prof. Dr. Dosen Pengampu',
            'email' => 'dosen@che.ui.ac.id',
            'password' => Hash::make('Dosen1234'),
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Create approved students
        $approvedStudents = [
            ['name' => 'Budi Santoso', 'email' => 'budi@ui.ac.id', 'nim' => '2106001001'],
            ['name' => 'Sari Indah', 'email' => 'sari@ui.ac.id', 'nim' => '2106001002'],
        ];

        foreach ($approvedStudents as $studentData) {
            User::create([
                'name' => $studentData['name'],
                'email' => $studentData['email'],
                'nim' => $studentData['nim'],
                'password' => Hash::make('Student1234'),
                'status' => 'approved',
                'email_verified_at' => now(),
            ]);
        }

        // Create pending students
        $pendingStudents = [
            ['name' => 'Ahmad Wijaya', 'email' => 'ahmad@ui.ac.id', 'nim' => '2106001003'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@ui.ac.id', 'nim' => '2106001004'],
            ['name' => 'Eko Prabowo', 'email' => 'eko@ui.ac.id', 'nim' => '2106001005'],
            ['name' => 'Fitri Handayani', 'email' => 'fitri@ui.ac.id', 'nim' => '2106001006'],
            ['name' => 'Gilang Ramadhan', 'email' => 'gilang@ui.ac.id', 'nim' => '2106001007'],
        ];

        foreach ($pendingStudents as $studentData) {
            User::create([
                'name' => $studentData['name'],
                'email' => $studentData['email'],
                'nim' => $studentData['nim'],
                'password' => Hash::make('Student1234'),
                'status' => 'pending',
            ]);
        }

        // Create equipment (8+ per lab)
        $categories = Category::all();
        
        foreach ($labs as $lab) {
            foreach ($categories as $category) {
                Equipment::factory()->count(2)->create([
                    'lab_id' => $lab->id,
                    'category_id' => $category->id,
                ]);
            }
        }

        // Create landing page content
        LandingPageContent::factory()->create([
            'updated_by' => $admin->id,
        ]);
    }
}