import React from 'react';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import InputError from '@/components/input-error';
import AuthLayout from '@/layouts/auth-layout';



export default function ForgotPasswordTicket() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        reason: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('tickets-password.store'));
    };

    return (
        <AuthLayout title="Bantuan Password" description="Ajukan permintaan bantuan reset password ke admin/laboran">
            <div className="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <Card className="w-full max-w-md">
                    <CardHeader className="space-y-1">
                        <CardTitle className="text-2xl font-bold text-center">
                            🆘 Bantuan Password
                        </CardTitle>
                        <CardDescription className="text-center">
                            Ajukan permintaan bantuan reset password ke admin/laboran
                        </CardDescription>
                    </CardHeader>
                    <form onSubmit={handleSubmit}>
                        <CardContent className="space-y-4">
                            <div className="space-y-2">
                                <Label htmlFor="email">Email</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="email@ui.ac.id atau email yang terdaftar"
                                    required
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="space-y-2">
                                <Label htmlFor="reason">Alasan (Opsional)</Label>
                                <textarea
                                    id="reason"
                                    className="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    value={data.reason}
                                    onChange={(e) => setData('reason', e.target.value)}
                                    placeholder="Jelaskan alasan mengapa Anda membutuhkan bantuan password..."
                                    maxLength={1000}
                                />
                                <InputError message={errors.reason} />
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button type="submit" className="w-full" disabled={processing}>
                                {processing ? '⏳ Mengirim...' : '📝 Kirim Permintaan'}
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </AuthLayout>
    );
}