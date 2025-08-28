<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $labs = [
            [
                'name' => 'Lab Operasi Teknik Kimia (OTK)',
                'slug' => 'lab-operasi-teknik-kimia-otk',
                'location' => 'Gedung Teknik Kimia Lantai 1',
                'capacity' => 30,
                'description' => 'Laboratorium untuk praktikum operasi teknik kimia, dilengkapi dengan berbagai peralatan proses seperti distilasi, absorpsi, dan heat exchanger.',
            ],
            [
                'name' => 'Lab Analisis Instrumen',
                'slug' => 'lab-analisis-instrumen',
                'location' => 'Gedung Teknik Kimia Lantai 2',
                'capacity' => 25,
                'description' => 'Laboratorium analisis dengan instrumen canggih seperti HPLC, GC, spektrofotometer untuk analisis kualitatif dan kuantitatif.',
            ],
            [
                'name' => 'Lab Termodinamika',
                'slug' => 'lab-termodinamika',
                'location' => 'Gedung Teknik Kimia Lantai 3',
                'capacity' => 20,
                'description' => 'Laboratorium untuk eksperimen termodinamika, kesetimbangan fase, dan sifat termodinamika zat.',
            ],
            [
                'name' => 'Lab Pengolahan Limbah',
                'slug' => 'lab-pengolahan-limbah',
                'location' => 'Gedung Baru Teknik Lantai 4',
                'capacity' => 35,
                'description' => 'Laboratorium khusus untuk riset dan praktikum pengolahan limbah cair dan padat dengan teknologi ramah lingkungan.',
            ],
        ];

        foreach ($labs as $labData) {
            $labData['operational_hours'] = [
                'monday' => ['start' => '08:00', 'end' => '17:00'],
                'tuesday' => ['start' => '08:00', 'end' => '17:00'],
                'wednesday' => ['start' => '08:00', 'end' => '17:00'],
                'thursday' => ['start' => '08:00', 'end' => '17:00'],
                'friday' => ['start' => '08:00', 'end' => '16:00'],
                'saturday' => ['start' => '08:00', 'end' => '12:00'],
                'sunday' => null
            ];
            $labData['contact_email'] = strtolower(str_replace([' ', '(', ')'], ['.', '', ''], $labData['name'])) . '@che.ui.ac.id';
            $labData['contact_phone'] = '(021) 7863516 ext. ' . (101 + array_search($labData, $labs));
            $labData['gallery_images'] = ['/images/labs/' . $labData['slug'] . '-1.jpg', '/images/labs/' . $labData['slug'] . '-2.jpg'];
            $labData['sop_document_path'] = '/documents/sop-' . $labData['slug'] . '.pdf';
            $labData['sds_links'] = ['https://chemlab.che.ui.ac.id/sds/' . $labData['slug']];
            $labData['is_active'] = true;

            Lab::create($labData);
        }
    }
}