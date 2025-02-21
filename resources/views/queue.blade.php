<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queue List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Queue List</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($queueEntries as $entry)
                    <tr>
                        <td>{{ $entry->name }}</td>
                        <td>{{ $entry->gender }}</td>
                        <td>{{ is_array($entry->purpose) ? implode(', ', $entry->purpose) : $entry->purpose }}</td>
                        <td>
                            <form action="{{ route('queue.updateStatus', $entry->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    @foreach(['waiting','e-registration','oec','information_sheet','welfare_registration_and_division','direct_hire','SENA','done'] as $status)
                                        <option value="{{ $status }}" {{ $entry->status === $status ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('queue.edit', $entry->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('queue.destroy', $entry->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ url('/') }}" class="btn btn-primary">Back</a>
    </div>
</body>
</html>
