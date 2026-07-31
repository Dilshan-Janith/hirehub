<?php

namespace App\Http\Controllers;

use App\Enums\ListingType;
use App\Models\Listing;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'featuredListings' => Listing::query()
                ->with('category', 'provider.user')
                ->where('status', 'active')
                ->where('is_featured', true)
                ->latest()
                ->take(6)
                ->get(),
            'manpowerCount' => Listing::query()
                ->where('status', 'active')
                ->where('type', ListingType::MANPOWER)
                ->count(),
            'toolCount' => Listing::query()
                ->where('status', 'active')
                ->where('type', ListingType::TOOL)
                ->count(),
        ]);
    }
}
