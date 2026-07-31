@csrf
@isset($provider) @method('PUT') @endisset

<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" value="{{ old('name', $provider->user->name ?? '') }}" required></div>
    <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control" name="email" value="{{ old('email', $provider->user->email ?? '') }}" required></div>
    <div class="col-md-6"><label class="form-label">Phone</label><input class="form-control" name="phone" value="{{ old('phone', $provider->user->phone ?? '') }}" required></div>
    <div class="col-md-6">
        <label class="form-label">Provider type</label>
        <select class="form-select" name="provider_type">
            @foreach (['worker' => 'Worker', 'equipment_owner' => 'Equipment owner'] as $value => $label)
                <option value="{{ $value }}" @selected(old('provider_type', $provider->provider_type ?? '') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6"><label class="form-label">NIC / registration</label><input class="form-control" name="nic_or_registration_no" value="{{ old('nic_or_registration_no', $provider->nic_or_registration_no ?? '') }}"></div>
    <div class="col-md-6"><label class="form-label">District</label><input class="form-control" name="district" value="{{ old('district', $provider->district ?? '') }}" required></div>
    <div class="col-12"><label class="form-label">Address</label><input class="form-control" name="address" value="{{ old('address', $provider->address ?? '') }}"></div>
    <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" name="description">{{ old('description', $provider->description ?? '') }}</textarea></div>
    <div class="col-md-6">
        <label class="form-label">Verification</label>
        <select class="form-select" name="verification_status">
            @foreach (['pending', 'verified', 'rejected'] as $status)
                <option value="{{ $status }}" @selected(old('verification_status', $provider->verification_status ?? 'pending') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Availability</label>
        <select class="form-select" name="availability_status">
            @foreach (['available', 'busy', 'unavailable'] as $status)
                <option value="{{ $status }}" @selected(old('availability_status', $provider->availability_status ?? 'available') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
</div>
<button class="btn btn-dark mt-4">Save provider</button>
