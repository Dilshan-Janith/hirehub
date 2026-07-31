<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListingRequest;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ProviderProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ListingController extends Controller
{
    public function index(): View
    {
        return view('admin.listings.index', [
            'listings' => Listing::with('category', 'provider.user')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.listings.create', $this->formData());
    }

    public function store(ListingRequest $request): RedirectResponse
    {
        Listing::create($request->validated());

        return redirect()->route('admin.listings.index')
            ->with('success', 'Listing created.');
    }

    public function edit(Listing $listing): View
    {
        return view('admin.listings.edit', [
            'listing' => $listing,
            ...$this->formData(),
        ]);
    }

    public function update(ListingRequest $request, Listing $listing): RedirectResponse
    {
        $listing->update($request->validated());

        return redirect()->route('admin.listings.index')
            ->with('success', 'Listing updated.');
    }

    public function destroy(Listing $listing): RedirectResponse
    {
        if ($listing->bookingItems()->exists()) {
            $listing->update(['status' => 'inactive']);

            return back()->with('success', 'Listing has booking history, so it was deactivated instead of deleted.');
        }

        $listing->delete();

        return back()->with('success', 'Listing deleted.');
    }

    private function formData(): array
    {
        return [
            'categories' => Category::where('status', 'active')->orderBy('name')->get(),
            'providers' => ProviderProfile::with('user')
                ->where('verification_status', 'verified')
                ->orderBy('district')
                ->get(),
        ];
    }
}
