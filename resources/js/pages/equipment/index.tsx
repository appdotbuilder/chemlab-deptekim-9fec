import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Category {
    id: number;
    name: string;
    slug: string;
    color: string;
}

interface Lab {
    id: number;
    name: string;
    slug: string;
}

interface Equipment {
    id: number;
    name: string;
    asset_code: string;
    manufacturer?: string;
    model?: string;
    condition: string;
    availability_status: string;
    images?: string[];
    category: Category;
    lab: Lab;
}

interface PaginatedEquipment {
    data: Equipment[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

interface Filters {
    category?: string;
    lab?: string;
    availability?: string;
    search?: string;
}

interface Props {
    equipment: PaginatedEquipment;
    categories: Category[];
    labs: Lab[];
    filters: Filters;
    [key: string]: unknown;
}

const conditionColors = {
    excellent: 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
    good: 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400',
    fair: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400',
    poor: 'bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400',
    needs_repair: 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400',
};

const statusColors = {
    available: 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
    borrowed: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400',
    maintenance: 'bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400',
    retired: 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400',
};

export default function EquipmentIndex({ equipment, categories, labs, filters }: Props) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');

    const handleFilterChange = (key: string, value: string) => {
        const newFilters: Record<string, string | undefined> = { ...filters, [key]: value || undefined };
        if (!value) delete newFilters[key];
        
        router.get(route('equipment.index'), newFilters, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        handleFilterChange('search', searchTerm);
    };

    return (
        <>
            <Head title="Equipment - ChemLab Deptekim" />
            <AppShell>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {/* Header */}
                    <div className="mb-8">
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            🔬 Equipment Laboratory
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400">
                            Browse and search laboratory equipment across all departments
                        </p>
                    </div>

                    {/* Filters */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                            {/* Search */}
                            <div className="lg:col-span-2">
                                <form onSubmit={handleSearch}>
                                    <input
                                        type="text"
                                        placeholder="Search equipment, asset code, manufacturer..."
                                        value={searchTerm}
                                        onChange={(e) => setSearchTerm(e.target.value)}
                                        className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    />
                                </form>
                            </div>

                            {/* Category Filter */}
                            <select
                                value={filters.category || ''}
                                onChange={(e) => handleFilterChange('category', e.target.value)}
                                className="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">All Categories</option>
                                {categories.map(category => (
                                    <option key={category.id} value={category.id}>
                                        {category.name}
                                    </option>
                                ))}
                            </select>

                            {/* Lab Filter */}
                            <select
                                value={filters.lab || ''}
                                onChange={(e) => handleFilterChange('lab', e.target.value)}
                                className="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            >
                                <option value="">All Labs</option>
                                {labs.map(lab => (
                                    <option key={lab.id} value={lab.id}>
                                        {lab.name}
                                    </option>
                                ))}
                            </select>
                        </div>

                        {/* Availability Filter */}
                        <div className="flex flex-wrap gap-2">
                            <button
                                onClick={() => handleFilterChange('availability', '')}
                                className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                    !filters.availability 
                                        ? 'bg-blue-600 text-white' 
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                }`}
                            >
                                All
                            </button>
                            <button
                                onClick={() => handleFilterChange('availability', 'available')}
                                className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                    filters.availability === 'available'
                                        ? 'bg-green-600 text-white' 
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                }`}
                            >
                                ✅ Available
                            </button>
                            <button
                                onClick={() => handleFilterChange('availability', 'borrowed')}
                                className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                    filters.availability === 'borrowed'
                                        ? 'bg-yellow-600 text-white' 
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                }`}
                            >
                                📋 Borrowed
                            </button>
                            <button
                                onClick={() => handleFilterChange('availability', 'maintenance')}
                                className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                    filters.availability === 'maintenance'
                                        ? 'bg-orange-600 text-white' 
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                }`}
                            >
                                🔧 Maintenance
                            </button>
                        </div>
                    </div>

                    {/* Results Count */}
                    <div className="mb-4">
                        <p className="text-gray-600 dark:text-gray-400">
                            Showing {equipment.data.length} of {equipment.total} equipment
                        </p>
                    </div>

                    {/* Equipment Grid */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        {equipment.data.map((item) => (
                            <Link
                                key={item.id}
                                href={route('equipment.show', item.id)}
                                className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow"
                            >
                                {/* Image */}
                                <div className="h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center">
                                    {item.images && item.images.length > 0 ? (
                                        <img
                                            src={item.images[0]}
                                            alt={item.name}
                                            className="w-full h-full object-cover"
                                        />
                                    ) : (
                                        <div className="text-6xl opacity-50">🔬</div>
                                    )}
                                </div>

                                <div className="p-4">
                                    {/* Status Badges */}
                                    <div className="flex gap-2 mb-2">
                                        <span className={`px-2 py-1 text-xs font-medium rounded-full ${statusColors[item.availability_status as keyof typeof statusColors]}`}>
                                            {item.availability_status.replace('_', ' ').toUpperCase()}
                                        </span>
                                        <span className={`px-2 py-1 text-xs font-medium rounded-full ${conditionColors[item.condition as keyof typeof conditionColors]}`}>
                                            {item.condition.replace('_', ' ').toUpperCase()}
                                        </span>
                                    </div>

                                    {/* Equipment Name */}
                                    <h3 className="font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2">
                                        {item.name}
                                    </h3>

                                    {/* Asset Code */}
                                    <p className="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                        #{item.asset_code}
                                    </p>

                                    {/* Manufacturer & Model */}
                                    {(item.manufacturer || item.model) && (
                                        <p className="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                            {item.manufacturer} {item.model}
                                        </p>
                                    )}

                                    {/* Category */}
                                    <div className="flex items-center gap-2 mb-2">
                                        <div
                                            className="w-3 h-3 rounded-full"
                                            style={{ backgroundColor: item.category.color }}
                                        ></div>
                                        <span className="text-sm text-gray-600 dark:text-gray-300">
                                            {item.category.name}
                                        </span>
                                    </div>

                                    {/* Lab */}
                                    <p className="text-sm text-gray-500 dark:text-gray-400 truncate">
                                        📍 {item.lab.name}
                                    </p>
                                </div>
                            </Link>
                        ))}
                    </div>

                    {/* Empty State */}
                    {equipment.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-6xl mb-4">🔍</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                No equipment found
                            </h3>
                            <p className="text-gray-600 dark:text-gray-400 mb-4">
                                Try adjusting your search criteria or filters
                            </p>
                            <button
                                onClick={() => router.get(route('equipment.index'))}
                                className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                            >
                                Clear Filters
                            </button>
                        </div>
                    )}

                    {/* Pagination */}
                    {equipment.last_page > 1 && (
                        <div className="flex justify-center space-x-2">
                            {Array.from({ length: equipment.last_page }, (_, i) => i + 1).map(page => (
                                <button
                                    key={page}
                                    onClick={() => router.get(route('equipment.index'), { ...filters, page })}
                                    className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                                        page === equipment.current_page
                                            ? 'bg-blue-600 text-white'
                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                    }`}
                                >
                                    {page}
                                </button>
                            ))}
                        </div>
                    )}
                </div>
            </AppShell>
        </>
    );
}