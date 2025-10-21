<!-- @extends('layouts.app')

@section('content') -->
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Wishlist</h2>
        <a href="{{ route('wishlist.create') }}" class="btn btn-primary mb-3 float-right"> Add Wishlist</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Event</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->user->name ?? 'N/A' }}</td>
                <td>{{ $d->event->title ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('wishlist.edit', $d->id) }}" class="btn btn-sm btn-info">Edit</a>
                    
                    <form action="{{ route('wishlist.destroy', $d->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No wishlist items found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<!-- @endsection -->