<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProviderRequest;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProviderController extends Controller
{
    public function index(): View
    {
        return view('admin.providers.index', [
            'providers' => ProviderProfile::with('user')->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.providers.create');
    }

    public function store(ProviderRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $data = $request->validated();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Str::password(24),
                'role' => UserRole::PROVIDER,
                'status' => 'active',
            ]);

            $user->providerProfile()->create(collect($data)
                ->except(['name', 'email', 'phone'])
                ->all());
        });

        return redirect()->route('admin.providers.index')
            ->with('success', 'Provider created.');
    }

    public function edit(ProviderProfile $provider): View
    {
        $provider->load('user');

        return view('admin.providers.edit', compact('provider'));
    }

    public function update(ProviderRequest $request, ProviderProfile $provider): RedirectResponse
    {
        DB::transaction(function () use ($request, $provider): void {
            $data = $request->validated();

            $provider->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);

            $provider->update(collect($data)
                ->except(['name', 'email', 'phone'])
                ->all());
        });

        return redirect()->route('admin.providers.index')
            ->with('success', 'Provider updated.');
    }

    public function destroy(ProviderProfile $provider): RedirectResponse
    {
        if ($provider->assignedBookings()->exists()) {
            return back()->withErrors(['provider' => 'This provider has booking history and cannot be deleted.']);
        }

        $provider->user()->delete();

        return back()->with('success', 'Provider deleted.');
    }
}
