import React from 'react';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import InputError from '@/components/input-error';
import AuthLayout from '@/layouts/auth-layout';



export default function RegisterMahasiswa() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        agree: false as boolean,
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('register.mahasiswa.store'));
    };

    return (
        <AuthLayout title="Daftar Mahasiswa" description="Registrasi akun mahasiswa UI untuk menggunakan sistem lab">
            <div className="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <Card className="w-full max-w-md">
                    <CardHeader className="space-y-1">
                        <CardTitle className="text-2xl font-bold text-center">
                            📚 Daftar Mahasiswa
                        </CardTitle>
                        <CardDescription className="text-center">
                            Registrasi akun mahasiswa UI untuk menggunakan sistem lab
                        </CardDescription>
                    </CardHeader>
                    <form onSubmit={handleSubmit}>
                        <CardContent className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="name">Nama Lengkap</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    placeholder="Masukkan nama lengkap"
                                    required
                                />
                                <InputError message={errors.name} />
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="email">Email Mahasiswa UI</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="nama@ui.ac.id"
                                    required
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="password">Password</Label>
                                <Input
                                    id="password"
                                    type="password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    placeholder="Minimal 8 karakter dengan huruf dan angka"
                                    required
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="password_confirmation">Konfirmasi Password</Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    placeholder="Ulangi password"
                                    required
                                />
                                <InputError message={errors.password_confirmation} />
                            </div>

                            <div className="flex items-center space-x-2">
                                <Checkbox
                                    id="agree"
                                    checked={data.agree}
                                    onCheckedChange={(checked) => setData('agree', !!checked)}
                                />
                                <Label htmlFor="agree" className="text-sm">
                                    Saya menyetujui SOP & Tata Tertib penggunaan lab
                                </Label>
                            </div>
                            <InputError message={errors.agree} />
                        </CardContent>
                        <CardFooter>
                            <Button type="submit" className="w-full" disabled={processing}>
                                {processing ? '⏳ Mendaftar...' : '🎓 Daftar Sekarang'}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </AuthLayout>
    );
}