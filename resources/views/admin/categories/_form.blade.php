@csrf
@isset($category) @method('PUT') @endisset

<div class="mb-3">
    <label class="form-label">Name</label>
    <input class="form-control" name="name" value="{{ old('name', $category->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Slug</label>
    <input class="form-control" name="slug" value="{{ old('slug', $category->slug ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Type</label>
    <select class="form-select" name="type">
        @foreach (['manpower' => 'Manpower', 'tool' => 'Tool'] as $value => $label)
            <option value="{{ $value }}" @selected(old('type', isset($category) ? $category->type->value : '') === $value)>{{ $label }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea class="form-control" name="description">{{ old('description', $category->description ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status">
            @foreach (['active', 'inactive'] as $status)
                <option value="{{ $status }}" @selected(old('status', $category->status ?? 'active') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Sort order</label>
        <input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
    </div>
</div>
<button class="btn btn-dark">Save category</button>
