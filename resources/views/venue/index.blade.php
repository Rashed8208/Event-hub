
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Venue List</h2>
        <a href="{{ route('venue.create') }}" class="btn btn-primary">+ Add New Venue</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>City</th>
                <th>Capacity</th>
                <th>Price/Day</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i=>$d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->city }}</td>
                <td>{{ $d->capacity }}</td>
                <td>${{$d->price_per_day }}</td>
                <td>
                    <span class="badge 
                        @if($venue->status == 'available') bg-success 
                        @elseif($venue->status == 'booked') bg-warning 
                        @else bg-secondary @endif">
                        {{ ucfirst($d->status) }}
                    </span>
                </td>
                <td>
                    @if($venue->image)
                        <img src="{{ asset('storage/' . $venue->image) }}" alt="Venue Image" width="80">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('venue.edit', $d->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('venue.destroy', $d->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No venues found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
