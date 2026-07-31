<?php

namespace App\Http\Controllers;

use App\Enums\ListingType;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListingController extends Controller
{
    public function manpower(Request $request): View
    {
        return $this->indexByType($request, ListingType::MANPOWER);
    }

    public function tools(Request $request): View
    {
        return $this->indexByType($request, ListingType::TOOL);
    }

    public function show(Listing $listing): View
    {
        abort_unless($listing->status === 'active', 404);

        return view('listings.show', [
            'listing' => $listing->load('category', 'provider.user'),
        ]);
    }

    private function indexByType(Request $request, ListingType $type): View
    {
        $listings = Listing::query()
            ->with('category', 'provider.user')
            ->where('status', 'active')
            ->where('type', $type)
            ->when($request->filled('district'), fn ($query) => $query->where('district', $request->string('district')))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = '%'.$request->string('search').'%';
                $query->where(fn ($q) => $q
                    ->where('name', 'like', $search)
                    ->orWhere('short_description', 'like', $search));
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('listings.index', compact('listings', 'type'));
    }
}
