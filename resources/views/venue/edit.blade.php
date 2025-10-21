
<div class="container mt-4">
    <h2>Edit Venue</h2>

    <form action="{{ route('venue.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $venue->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $venue->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $venue->address }}">
        </div>

        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $venue->city }}">
        </div>

        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $venue->capacity }}">
        </div>

        <div class="mb-3">
            <label>Price per Day</label>
            <input type="number" step="0.01" name="price_per_day" class="form-control" value="{{ $venue->price_per_day }}">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            @if($venue->image)
                <img src="{{ asset('storage/' . $venue->image) }}" alt="Venue Image" width="100">
            @else
                <span class="text-muted">No image uploaded</span>
            @endif
        </div>

        <div class="mb-3">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $venue->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="booked" {{ $venue->status == 'booked' ? 'selected' : '' }}>Booked</option>
                <option value="unavailable" {{ $venue->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('venue.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

