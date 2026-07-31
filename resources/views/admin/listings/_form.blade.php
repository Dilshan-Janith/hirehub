@csrf
@isset($listing) @method('PUT') @endisset

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Provider</label>
        <select class="form-select" name="provider_id" required>
            @foreach ($providers as $provider)
                <option value="{{ $provider->id }}" @selected((int) old('provider_id', $listing->provider_id ?? 0) === $provider->id)>
                    {{ $provider->user->name }} — {{ $provider->district }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select class="form-select" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id', $listing->category_id ?? 0) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Type</label>
        <select class="form-select" name="type">
            @foreach (['manpower', 'tool'] as $type)
                <option value="{{ $type }}" @selected(old('type', isset($listing) ? $listing->type->value : '') === $type)>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" name="name" value="{{ old('name', $listing->name ?? '') }}" required></div>
    <div class="col-12"><label class="form-label">Slug</label><input class="form-control" name="slug" value="{{ old('slug', $listing->slug ?? '') }}" required></div>
    <div class="col-12"><label class="form-label">Short description</label><input class="form-control" name="short_description" value="{{ old('short_description', $listing->short_description ?? '') }}"></div>
    <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" name="description">{{ old('description', $listing->description ?? '') }}</textarea></div>
    <div class="col-md-4">
        <label class="form-label">Pricing unit</label>
        <select class="form-select" name="pricing_unit">
            @foreach (['hour', 'day', 'week', 'job'] as $unit)
                <option value="{{ $unit }}" @selected(old('pricing_unit', $listing->pricing_unit ?? 'day') === $unit)>{{ ucfirst($unit) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4"><label class="form-label">Price</label><input type="number" step="0.01" min="0" class="form-control" name="price" value="{{ old('price', $listing->price ?? 0) }}" required></div>
    <div class="col-md-4"><label class="form-label">Deposit</label><input type="number" step="0.01" min="0" class="form-control" name="deposit_amount" value="{{ old('deposit_amount', $listing->deposit_amount ?? 0) }}"></div>
    <div class="col-md-6"><label class="form-label">District</label><input class="form-control" name="district" value="{{ old('district', $listing->district ?? '') }}"></div>
    <div class="col-md-3"><label class="form-label">Quantity</label><input type="number" min="1" class="form-control" name="quantity" value="{{ old('quantity', $listing->quantity ?? 1) }}"></div>
    <div class="col-md-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status">
            @foreach (['active', 'inactive'] as $status)
                <option value="{{ $status }}" @selected(old('status', $listing->status ?? 'active') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 form-check ms-2">
        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured" @checked(old('is_featured', $listing->is_featured ?? false))>
        <label class="form-check-label" for="featured">Featured listing</label>
    </div>
</div>
<button class="btn btn-dark mt-4">Save listing</button>
