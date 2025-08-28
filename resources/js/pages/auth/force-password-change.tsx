import React from 'react';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import InputError from '@/components/input-error';
import AuthLayout from '@/layouts/auth-layout';



export default function ForcePasswordChange() {
    const { data, setData, post, processing, errors } = useForm({
        password: '',
        password_confirmation: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('password.force.update'));
    };

    return (
        <AuthLayout title="Ubah Password" description="Anda diharuskan mengubah password sebelum melanjutkan">
            <div className="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <Card className="w-full max-w-md">
                    <CardHeader className="space-y-1">
                        <CardTitle className="text-2xl font-bold text-center">
                            🔐 Ubah Password
                        </CardTitle>
                        <CardDescription className="text-center">
                            Anda diharuskan mengubah password sebelum melanjutkan
                        </CardDescription>
                    </CardHeader>
                    <form onSubmit={handleSubmit}>
                        <CardContent className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="password">Password Baru</Label>
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
                                <Label htmlFor="password_confirmation">Konfirmasi Password Baru</Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    placeholder="Ulangi password baru"
                                    required
                                />
                                <InputError message={errors.password_confirmation} />
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button type="submit" className="w-full" disabled={processing}>
                                {processing ? '⏳ Mengubah...' : '✅ Ubah Password'}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </AuthLayout>
    );
}