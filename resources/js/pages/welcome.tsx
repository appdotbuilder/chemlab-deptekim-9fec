import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

interface LandingContent {
    hero_title: string;
    hero_subtitle: string | null;
    hero_image_path: string | null;
    description: string | null;
    usage_guide: string | null;
    demo_content: string | null;
    faqs: Array<{ question: string; answer: string }> | null;
    contact_information: string | null;
    user_guide_link: string | null;
}

interface Stats {
    total_labs: number;
    total_equipment: number;
    active_loans: number;
    available_equipment: number;
}

interface Props {
    landingContent: LandingContent | null;
    stats: Stats;
    [key: string]: unknown;
}

export default function Welcome({ landingContent, stats }: Props) {
    const { auth } = usePage<SharedData>().props;

    const defaultContent = {
        hero_title: "🧪 ChemLab Deptekim",
        hero_subtitle: "Sistem Manajemen Peminjaman Peralatan Laboratorium Kimia UI",
        description: "Platform digital untuk mengelola peminjaman peralatan laboratorium, administrasi lab, dan monitoring real-time untuk Departemen Teknik Kimia UI."
    };

    const content = landingContent || defaultContent;

    return (
        <>
            <Head title="ChemLab Deptekim - Lab Equipment Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Navigation */}
                <nav className="bg-white/80 backdrop-blur-md border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between h-16">
                            <div className="flex items-center">
                                <div className="flex-shrink-0">
                                    <h1 className="text-xl font-bold text-gray-900 dark:text-white">
                                        🧪 ChemLab Deptekim
                                    </h1>
                                </div>
                            </div>
                            <div className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white font-medium"
                                        >
                                            Masuk
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                                        >
                                            Daftar
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </nav>

                {/* Hero Section */}
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div className="text-center">
                        <h1 className="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                            {content.hero_title}
                        </h1>
                        {content.hero_subtitle && (
                            <p className="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-4xl mx-auto">
                                {content.hero_subtitle}
                            </p>
                        )}
                        {content.description && (
                            <p className="text-lg text-gray-600 dark:text-gray-400 mb-12 max-w-3xl mx-auto">
                                {content.description}
                            </p>
                        )}
                        
                        {/* CTA Buttons */}
                        <div className="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center"
                                    >
                                        📝 Daftar Sekarang
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="bg-gray-100 hover:bg-gray-200 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700"
                                    >
                                        🔑 Masuk
                                    </Link>
                                </>
                            )}
                            {auth.user && (
                                <Link
                                    href={route('dashboard')}
                                    className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center"
                                >
                                    📊 Dashboard
                                </Link>
                            )}
                        </div>
                    </div>

                    {/* Stats */}
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
                        <div className="bg-white/60 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-200 dark:bg-gray-800/60 dark:border-gray-700">
                            <div className="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                {stats.total_labs}
                            </div>
                            <div className="text-gray-600 dark:text-gray-400">🏢 Laboratorium</div>
                        </div>
                        <div className="bg-white/60 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-200 dark:bg-gray-800/60 dark:border-gray-700">
                            <div className="text-3xl font-bold text-green-600 dark:text-green-400">
                                {stats.total_equipment}
                            </div>
                            <div className="text-gray-600 dark:text-gray-400">🔬 Total Peralatan</div>
                        </div>
                        <div className="bg-white/60 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-200 dark:bg-gray-800/60 dark:border-gray-700">
                            <div className="text-3xl font-bold text-yellow-600 dark:text-yellow-400">
                                {stats.active_loans}
                            </div>
                            <div className="text-gray-600 dark:text-gray-400">📋 Peminjaman Aktif</div>
                        </div>
                        <div className="bg-white/60 backdrop-blur-sm rounded-xl p-6 text-center border border-gray-200 dark:bg-gray-800/60 dark:border-gray-700">
                            <div className="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                {stats.available_equipment}
                            </div>
                            <div className="text-gray-600 dark:text-gray-400">✅ Tersedia</div>
                        </div>
                    </div>

                    {/* Features */}
                    <div className="grid md:grid-cols-3 gap-8 mb-16">
                        <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
                            <div className="text-4xl mb-4">🔍</div>
                            <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                Pencarian & Filter
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Cari peralatan berdasarkan kategori, laboratorium, ketersediaan, dan spesifikasi teknis dengan mudah.
                            </p>
                        </div>
                        
                        <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
                            <div className="text-4xl mb-4">📱</div>
                            <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                Notifikasi Real-time
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Dapatkan notifikasi langsung untuk persetujuan, pengingat batas waktu, dan update status peminjaman.
                            </p>
                        </div>
                        
                        <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
                            <div className="text-4xl mb-4">🛡️</div>
                            <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                Keamanan & JSA
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Wajib upload Job Safety Analysis, informasi PPE, dan data keselamatan untuk setiap peminjaman.
                            </p>
                        </div>
                        
                        <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
                            <div className="text-4xl mb-4">👥</div>
                            <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                Multi-Role Access
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Akses berbeda untuk Admin, Kepala Lab, Laboran, Dosen, dan Mahasiswa dengan kontrol yang tepat.
                            </p>
                        </div>
                        
                        <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
                            <div className="text-4xl mb-4">📊</div>
                            <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                Laporan & Analytics
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Generate laporan utilisasi, keterlambatan, dan statistik peminjaman dalam format Excel/PDF.
                            </p>
                        </div>
                        
                        <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700">
                            <div className="text-4xl mb-4">🔧</div>
                            <h3 className="text-xl font-semibold mb-3 text-gray-900 dark:text-white">
                                Manajemen Maintenance
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400">
                                Jadwal kalibrasi, riwayat maintenance, dan monitoring kondisi peralatan laboratorium.
                            </p>
                        </div>
                    </div>

                    {/* User Roles */}
                    <div className="bg-white/80 backdrop-blur-sm rounded-xl p-8 border border-gray-200 dark:bg-gray-800/80 dark:border-gray-700 mb-16">
                        <h2 className="text-2xl font-bold text-center mb-8 text-gray-900 dark:text-white">
                            👥 Roles & Akses
                        </h2>
                        <div className="grid md:grid-cols-5 gap-6">
                            <div className="text-center">
                                <div className="text-3xl mb-3">👑</div>
                                <h4 className="font-semibold text-gray-900 dark:text-white">Admin</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Full access, kelola users & system</p>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl mb-3">🎓</div>
                                <h4 className="font-semibold text-gray-900 dark:text-white">Kepala Lab</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Override approvals, view all lab data</p>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl mb-3">🔬</div>
                                <h4 className="font-semibold text-gray-900 dark:text-white">Laboran</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Kelola equipment & approve loans</p>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl mb-3">👨‍🏫</div>
                                <h4 className="font-semibold text-gray-900 dark:text-white">Dosen</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Submit loans untuk riset/praktikum</p>
                            </div>
                            <div className="text-center">
                                <div className="text-3xl mb-3">🎒</div>
                                <h4 className="font-semibold text-gray-900 dark:text-white">Mahasiswa</h4>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Self-register & submit loan requests</p>
                            </div>
                        </div>
                    </div>

                    {/* Contact */}
                    <div className="text-center">
                        <h2 className="text-2xl font-bold mb-4 text-gray-900 dark:text-white">
                            📞 Kontak & Bantuan
                        </h2>
                        <p className="text-gray-600 dark:text-gray-400 mb-6">
                            Butuh bantuan? Hubungi tim support atau akses panduan pengguna.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <button className="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                📖 User Guide
                            </button>
                            <button className="bg-gray-100 hover:bg-gray-200 text-gray-900 px-6 py-3 rounded-lg font-medium transition-colors dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                                💬 Support
                            </button>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-8">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center">
                            <p>&copy; 2024 ChemLab Deptekim - Departemen Teknik Kimia UI</p>
                            <p className="text-gray-400 mt-2">Sistem Manajemen Peminjaman Peralatan Laboratorium</p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}