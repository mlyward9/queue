@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Queue Entry</h2>

    <form action="{{ route('queue.update', $entry->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $entry->name }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                @foreach(['waiting','e-registration','oec','information_sheet','welfare_registration_and_division','direct_hire','SENA','done'] as $status)
                    <option value="{{ $status }}" {{ $entry->status == $status ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('queue.display') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
