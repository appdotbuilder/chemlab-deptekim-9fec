<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandingPageContent>
 */
class LandingPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hero_title' => '🧪 ChemLab Deptekim',
            'hero_subtitle' => 'Sistem Manajemen Peminjaman Peralatan Laboratorium Kimia UI',
            'hero_image_path' => '/images/hero/lab-hero.jpg',
            'description' => 'Platform digital untuk mengelola peminjaman peralatan laboratorium, administrasi lab, dan monitoring real-time untuk Departemen Teknik Kimia UI.',
            'usage_guide' => '<h3>Panduan Penggunaan</h3>
            <ol>
                <li><strong>Registrasi:</strong> Mahasiswa daftar dengan email @ui.ac.id, menunggu verifikasi admin</li>
                <li><strong>Login:</strong> Akses sistem dengan kredensial yang telah diverifikasi</li>
                <li><strong>Cari Equipment:</strong> Browse dan filter peralatan berdasarkan kategori dan lab</li>
                <li><strong>Ajukan Peminjaman:</strong> Pilih waktu, upload JSA, submit permohonan</li>
                <li><strong>Tunggu Approval:</strong> Laboran akan review dan approve/reject</li>
                <li><strong>Check-out:</strong> Ambil equipment dengan dokumentasi kondisi</li>
                <li><strong>Return:</strong> Kembalikan tepat waktu dengan kondisi baik</li>
            </ol>',
            'demo_content' => '<div>
                <h3>🎯 Fitur Utama</h3>
                <ul>
                    <li>✅ Multi-role access (Admin, Kepala Lab, Laboran, Dosen, Mahasiswa)</li>
                    <li>📱 Real-time notifications & reminders</li>
                    <li>🔍 Advanced search & filtering</li>
                    <li>🛡️ Mandatory JSA upload for safety</li>
                    <li>📊 Comprehensive reports & analytics</li>
                    <li>🔧 Equipment maintenance tracking</li>
                    <li>⏰ Booking conflict prevention</li>
                </ul>
            </div>',
            'faqs' => [
                [
                    'question' => 'Siapa yang bisa mendaftar di sistem ini?',
                    'answer' => 'Mahasiswa dengan email @ui.ac.id dapat self-register. Staff (Admin, Kepala Lab, Laboran, Dosen) harus didaftarkan oleh Admin dengan email @che.ui.ac.id.'
                ],
                [
                    'question' => 'Apa itu JSA dan mengapa wajib diupload?',
                    'answer' => 'Job Safety Analysis (JSA) adalah dokumen analisis keselamatan kerja yang wajib diupload sebelum meminjam equipment untuk memastikan keselamatan di laboratorium.'
                ],
                [
                    'question' => 'Bagaimana jika lupa password?',
                    'answer' => 'Gunakan fitur Password Help untuk submit ticket ke admin. Admin akan memberikan temporary password yang harus diganti saat login pertama.'
                ],
                [
                    'question' => 'Berapa lama maksimal peminjaman?',
                    'answer' => 'Durasi maksimal peminjaman ditentukan oleh kebijakan masing-masing laboratorium dan jenis equipment yang dipinjam.'
                ]
            ],
            'contact_information' => '<div>
                <h4>📧 Email Support</h4>
                <p>chemlab.support@che.ui.ac.id</p>
                
                <h4>📞 Telepon</h4>
                <p>(021) 7863516 ext. 101</p>
                
                <h4>🏢 Alamat</h4>
                <p>Departemen Teknik Kimia<br>
                Fakultas Teknik Universitas Indonesia<br>
                Depok 16424, Jawa Barat</p>
                
                <h4>⏰ Jam Operasional</h4>
                <p>Senin - Jumat: 08:00 - 17:00 WIB<br>
                Sabtu: 08:00 - 12:00 WIB</p>
            </div>',
            'user_guide_link' => '/docs/user-guide.pdf',
            'is_active' => true,
        ];
    }
}