<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Category;
use App\Models\Lab;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EquipmentController extends Controller
{
    /**
     * Display a listing of equipment.
     */
    public function index(Request $request)
    {
        $query = Equipment::with(['category', 'lab'])
            ->active();

        // Apply filters
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('lab') && $request->lab) {
            $query->where('lab_id', $request->lab);
        }

        if ($request->has('availability') && $request->availability) {
            $query->where('availability_status', $request->availability);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', "%{$search}%")
                  ->orWhere('asset_code', 'ILIKE', "%{$search}%")
                  ->orWhere('manufacturer', 'ILIKE', "%{$search}%")
                  ->orWhere('model', 'ILIKE', "%{$search}%");
            });
        }

        $equipment = $query->paginate(12)->withQueryString();

        $categories = Category::all();
        $labs = Lab::active()->get();

        return Inertia::render('equipment/index', [
            'equipment' => $equipment,
            'categories' => $categories,
            'labs' => $labs,
            'filters' => $request->only(['category', 'lab', 'availability', 'search']),
        ]);
    }

    /**
     * Display the specified equipment.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load(['category', 'lab', 'loans.borrower', 'maintenances']);

        return Inertia::render('equipment/show', [
            'equipment' => $equipment,
        ]);
    }
}