<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Lab;
use App\Models\LandingPageContent;
use App\Models\Loan;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the application homepage.
     */
    public function index()
    {
        $landingContent = LandingPageContent::getActive();
        
        // Get some statistics for the landing page
        $stats = [
            'total_labs' => Lab::active()->count(),
            'total_equipment' => Equipment::active()->count(),
            'active_loans' => Loan::active()->count(),
            'available_equipment' => Equipment::active()->available()->count(),
        ];

        return Inertia::render('welcome', [
            'landingContent' => $landingContent,
            'stats' => $stats,
        ]);
    }
}