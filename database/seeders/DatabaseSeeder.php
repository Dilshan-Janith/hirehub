<?php

namespace Database\Seeders;

use App\Enums\ListingType;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Listing;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@hirehub.test'],
            [
                'name' => 'HireHub Administrator',
                'phone' => '0770000000',
                'password' => Hash::make('password'),
                'role' => UserRole::ADMIN,
                'status' => 'active',
            ]
        );

        $workerUser = User::query()->updateOrCreate(
            ['email' => 'worker@hirehub.test'],
            [
                'name' => 'Kamal Perera',
                'phone' => '0771111111',
                'password' => Hash::make('password'),
                'role' => UserRole::PROVIDER,
                'status' => 'active',
            ]
        );

        $worker = ProviderProfile::query()->updateOrCreate(
            ['user_id' => $workerUser->id],
            [
                'provider_type' => 'worker',
                'nic_or_registration_no' => '901234567V',
                'district' => 'Colombo',
                'address' => 'Colombo',
                'description' => 'Verified construction and home-service provider.',
                'verification_status' => 'verified',
                'availability_status' => 'available',
            ]
        );

        $equipmentUser = User::query()->updateOrCreate(
            ['email' => 'tools@hirehub.test'],
            [
                'name' => 'Lanka Tool Rentals',
                'phone' => '0772222222',
                'password' => Hash::make('password'),
                'role' => UserRole::PROVIDER,
                'status' => 'active',
            ]
        );

        $equipment = ProviderProfile::query()->updateOrCreate(
            ['user_id' => $equipmentUser->id],
            [
                'provider_type' => 'equipment_owner',
                'nic_or_registration_no' => 'PV-12345',
                'district' => 'Gampaha',
                'address' => 'Gampaha',
                'description' => 'Construction equipment and power tool rentals.',
                'verification_status' => 'verified',
                'availability_status' => 'available',
            ]
        );

        $construction = Category::query()->updateOrCreate(
            ['slug' => 'construction-workers'],
            [
                'name' => 'Construction Workers',
                'type' => ListingType::MANPOWER,
                'description' => 'Skilled and general workers for construction projects.',
                'status' => 'active',
                'sort_order' => 1,
            ]
        );

        $homeServices = Category::query()->updateOrCreate(
            ['slug' => 'home-services'],
            [
                'name' => 'Home Services',
                'type' => ListingType::MANPOWER,
                'description' => 'Electricians, plumbers and maintenance workers.',
                'status' => 'active',
                'sort_order' => 2,
            ]
        );

        $powerTools = Category::query()->updateOrCreate(
            ['slug' => 'power-tools'],
            [
                'name' => 'Power Tools',
                'type' => ListingType::TOOL,
                'description' => 'Portable tools for construction and maintenance.',
                'status' => 'active',
                'sort_order' => 3,
            ]
        );

        $heavyEquipment = Category::query()->updateOrCreate(
            ['slug' => 'heavy-equipment'],
            [
                'name' => 'Heavy Equipment',
                'type' => ListingType::TOOL,
                'description' => 'Machines and equipment for larger projects.',
                'status' => 'active',
                'sort_order' => 4,
            ]
        );

        $listings = [
            [
                'provider_id' => $worker->id,
                'category_id' => $construction->id,
                'type' => ListingType::MANPOWER,
                'name' => 'Experienced Mason',
                'slug' => 'experienced-mason',
                'short_description' => 'Masonry work for houses, walls and renovations.',
                'description' => 'Experienced mason available for daily hire in Colombo and nearby areas.',
                'pricing_unit' => 'day',
                'price' => 5000,
                'district' => 'Colombo',
                'quantity' => 1,
                'deposit_amount' => 0,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'provider_id' => $worker->id,
                'category_id' => $homeServices->id,
                'type' => ListingType::MANPOWER,
                'name' => 'Qualified Electrician',
                'slug' => 'qualified-electrician',
                'short_description' => 'Electrical installation, inspection and repair.',
                'description' => 'Qualified electrician for home and small commercial jobs.',
                'pricing_unit' => 'job',
                'price' => 4500,
                'district' => 'Colombo',
                'quantity' => 1,
                'deposit_amount' => 0,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'provider_id' => $equipment->id,
                'category_id' => $powerTools->id,
                'type' => ListingType::TOOL,
                'name' => 'Electric Drill',
                'slug' => 'electric-drill',
                'short_description' => 'Heavy-duty electric drill for daily rental.',
                'description' => 'Includes standard drill bits. Customer is responsible for safe operation.',
                'pricing_unit' => 'day',
                'price' => 1800,
                'district' => 'Gampaha',
                'quantity' => 4,
                'deposit_amount' => 5000,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'provider_id' => $equipment->id,
                'category_id' => $heavyEquipment->id,
                'type' => ListingType::TOOL,
                'name' => 'Concrete Mixer',
                'slug' => 'concrete-mixer',
                'short_description' => 'Concrete mixer for construction projects.',
                'description' => 'Daily rental. Delivery is quoted separately based on location.',
                'pricing_unit' => 'day',
                'price' => 8500,
                'district' => 'Gampaha',
                'quantity' => 2,
                'deposit_amount' => 15000,
                'is_featured' => true,
                'status' => 'active',
            ],
        ];

        foreach ($listings as $listing) {
            Listing::query()->updateOrCreate(
                ['slug' => $listing['slug']],
                $listing
            );
        }
    }
}
