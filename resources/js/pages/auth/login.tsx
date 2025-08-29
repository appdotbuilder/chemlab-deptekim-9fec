import { Head, useForm } from '@inertiajs/react';
import { Eye, EyeOff, LoaderCircle } from 'lucide-react';
import { FormEventHandler, useState } from 'react';

import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

type LoginForm = {
    email: string;
    password: string;
    remember: boolean;
};

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
    [key: string]: unknown;
}

export default function Login({ status, canResetPassword }: LoginProps) {
    const [showPassword, setShowPassword] = useState(false);
    const { data, setData, post, processing, errors, reset } = useForm<Required<LoginForm>>({
        email: '',
        password: '',
        remember: false,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('login'), {
            onFinish: () => reset('password'),
            preserveScroll: true,
        });
    };

    return (
        <>
            <Head title="Masuk" />
            <div className="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50 dark:from-slate-900 dark:to-slate-950 flex items-center justify-center px-4">
                <div className="w-full max-w-5xl grid md:grid-cols-2 gap-8 items-center">
                    {/* Left: info */}
                    <div className="hidden md:block">
                        <h1 className="text-3xl font-bold tracking-tight">ChemLab Deptekim</h1>
                        <p className="mt-3 text-slate-600 dark:text-slate-300">
                            Sistem terintegrasi peminjaman & pengembalian alat laboratorium.
                        </p>
                        <ul className="mt-6 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                            <li>• Persetujuan oleh Laboran sesuai lab</li>
                            <li>• Unggah JSA (PDF) saat pengajuan</li>
                            <li>• Laporan Excel/PDF & dashboard chart</li>
                        </ul>
                    </div>

                    {/* Right: form card */}
                    <div className="bg-white/90 dark:bg-slate-800/90 backdrop-blur rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 p-8">
                        <h2 className="text-xl font-semibold">Masuk Akun</h2>

                        {status && (
                            <div className="mt-4 mb-4 text-center text-sm font-medium text-green-600">
                                {status}
                            </div>
                        )}

                        <form onSubmit={submit} className="mt-6 space-y-4">
                            {/* Email */}
                            <div>
                                <Label htmlFor="email" className="block text-sm font-medium mb-1">
                                    Email
                                </Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    autoFocus
                                    autoComplete="username"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="nama@ui.ac.id atau nama@che.ui.ac.id"
                                    className="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 px-3 h-11"
                                />
                                <InputError message={errors.email} />
                            </div>

                            {/* Password */}
                            <div>
                                <Label htmlFor="password" className="block text-sm font-medium mb-1">
                                    Kata Sandi
                                </Label>
                                <div className="relative">
                                    <Input
                                        id="password"
                                        type={showPassword ? 'text' : 'password'}
                                        required
                                        minLength={8}
                                        autoComplete="current-password"
                                        value={data.password}
                                        onChange={(e) => setData('password', e.target.value)}
                                        className="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 px-3 h-11 pr-28"
                                    />
                                    <button
                                        type="button"
                                        className="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-indigo-600 hover:underline flex items-center gap-1"
                                        onClick={() => setShowPassword(!showPassword)}
                                    >
                                        {showPassword ? (
                                            <>
                                                <EyeOff className="h-4 w-4" />
                                                Sembunyikan
                                            </>
                                        ) : (
                                            <>
                                                <Eye className="h-4 w-4" />
                                                Tampilkan
                                            </>
                                        )}
                                    </button>
                                </div>
                                <InputError message={errors.password} />
                            </div>

                            {/* Remember & Help */}
                            <div className="flex items-center justify-between">
                                <label className="inline-flex items-center gap-2 text-sm cursor-pointer">
                                    <Checkbox
                                        id="remember"
                                        checked={data.remember}
                                        onCheckedChange={(checked) => setData('remember', !!checked)}
                                        className="rounded"
                                    />
                                    <span>Ingat saya</span>
                                </label>
                                {canResetPassword && (
                                    <TextLink 
                                        href={route('password.ticket')} 
                                        className="text-sm text-indigo-600 hover:underline"
                                    >
                                        Butuh bantuan password?
                                    </TextLink>
                                )}
                            </div>

                            {/* Submit */}
                            <Button
                                type="submit"
                                disabled={processing}
                                className="w-full rounded-xl h-11 mt-2 bg-indigo-600 text-white font-semibold hover:bg-indigo-700 disabled:opacity-60 transition"
                            >
                                {processing ? (
                                    <>
                                        <LoaderCircle className="h-4 w-4 animate-spin mr-2" />
                                        Memproses...
                                    </>
                                ) : (
                                    'Masuk'
                                )}
                            </Button>

                            {/* Register link */}
                            <p className="text-sm text-center mt-3">
                                Belum punya akun mahasiswa?{' '}
                                <TextLink 
                                    href={route('register.mahasiswa')} 
                                    className="text-indigo-600 hover:underline"
                                >
                                    Daftar di sini
                                </TextLink>
                            </p>

                            {/* General form error */}
                            {Object.keys(errors).length > 0 && !errors.email && !errors.password && (
                                <div className="text-red-600 text-sm mt-2 text-center">
                                    Terjadi kesalahan. Periksa kembali kredensial Anda.
                                </div>
                            )}
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}