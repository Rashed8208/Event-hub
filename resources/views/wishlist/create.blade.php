@extends('layouts.backend')

@section('content')
<div class="container mt-4">
    <h2>Add to Wishlist</h2>

    <form action="{{ route('wishlist.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-select" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Event</label>
            <select name="event_id" class="form-select" required>
                <option value="">-- Select Event --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection 
