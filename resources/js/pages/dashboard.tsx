import { type SharedData } from '@/types';
import { AppShell } from '@/components/app-shell';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Dashboard() {
    const { auth } = usePage<SharedData>().props;
    const user = auth.user;

    return (
        <>
            <Head title="Dashboard - ChemLab Deptekim" />
            <AppShell>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {/* Welcome Header */}
                    <div className="mb-8">
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            👋 Welcome back, {user?.name}!
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            ChemLab Deptekim - Lab Equipment Management System
                        </p>
                    </div>

                    {/* Quick Stats */}
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <div className="flex items-center">
                                <div className="text-3xl mb-2">🔬</div>
                                <div className="ml-4">
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Equipment</p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">124</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <div className="flex items-center">
                                <div className="text-3xl mb-2">✅</div>
                                <div className="ml-4">
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Available</p>
                                    <p className="text-2xl font-bold text-green-600 dark:text-green-400">89</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <div className="flex items-center">
                                <div className="text-3xl mb-2">📋</div>
                                <div className="ml-4">
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Active Loans</p>
                                    <p className="text-2xl font-bold text-yellow-600 dark:text-yellow-400">23</p>
                                </div>
                            </div>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                            <div className="flex items-center">
                                <div className="text-3xl mb-2">⚠️</div>
                                <div className="ml-4">
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Overdue</p>
                                    <p className="text-2xl font-bold text-red-600 dark:text-red-400">3</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Quick Actions */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <Link 
                            href={route('equipment.index')}
                            className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow"
                        >
                            <div className="text-4xl mb-4">🔍</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Browse Equipment
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                Search and filter laboratory equipment across all departments
                            </p>
                        </Link>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow cursor-pointer">
                            <div className="text-4xl mb-4">📝</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                New Loan Request
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                Submit a new equipment loan request with JSA documentation
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow cursor-pointer">
                            <div className="text-4xl mb-4">📊</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                My Loans
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                View and manage your current and past loan requests
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow cursor-pointer">
                            <div className="text-4xl mb-4">🏢</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Laboratory Info
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                View lab schedules, SOPs, safety guidelines, and contact info
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow cursor-pointer">
                            <div className="text-4xl mb-4">🔔</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Notifications
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                Check approvals, reminders, and system updates
                            </p>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow cursor-pointer">
                            <div className="text-4xl mb-4">📞</div>
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Support & Help
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 text-sm">
                                Get help with password reset, user guide, or contact support
                            </p>
                        </div>
                    </div>

                    {/* Recent Activity */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
                                📈 Recent Activity
                            </h2>
                        </div>
                        <div className="p-6">
                            <div className="space-y-4">
                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">✅</div>
                                    <div>
                                        <p className="text-sm font-medium text-gray-900 dark:text-white">
                                            Loan request approved
                                        </p>
                                        <p className="text-xs text-gray-500 dark:text-gray-400">
                                            Your request for Spektrofotometer UV-Vis (EQ001) has been approved
                                        </p>
                                        <p className="text-xs text-gray-400 dark:text-gray-500">2 hours ago</p>
                                    </div>
                                </div>

                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">📝</div>
                                    <div>
                                        <p className="text-sm font-medium text-gray-900 dark:text-white">
                                            New loan request submitted
                                        </p>
                                        <p className="text-xs text-gray-500 dark:text-gray-400">
                                            Submitted request for HPLC System (EQ023) - pending approval
                                        </p>
                                        <p className="text-xs text-gray-400 dark:text-gray-500">1 day ago</p>
                                    </div>
                                </div>

                                <div className="flex items-start space-x-3">
                                    <div className="text-2xl">🔄</div>
                                    <div>
                                        <p className="text-sm font-medium text-gray-900 dark:text-white">
                                            Equipment returned
                                        </p>
                                        <p className="text-xs text-gray-500 dark:text-gray-400">
                                            Successfully returned pH Meter Digital (EQ045) in good condition
                                        </p>
                                        <p className="text-xs text-gray-400 dark:text-gray-500">3 days ago</p>
                                    </div>
                                </div>
                            </div>

                            <div className="mt-6 text-center">
                                <button className="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm">
                                    View all activity
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </AppShell>
        </>
    );
}