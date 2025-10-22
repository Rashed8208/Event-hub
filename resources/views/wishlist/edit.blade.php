@extends('layouts.backend')

@section('content')
<div class="container mt-4">
    <h2>Edit Wishlist</h2>

    <form action="{{ route('wishlist.update', $d->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-select" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $wishlist->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Event</label>
            <select name="event_id" class="form-select" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $wishlist->event_id == $event->id ? 'selected' : '' }}>
                        {{ $event->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
 @endsection 
