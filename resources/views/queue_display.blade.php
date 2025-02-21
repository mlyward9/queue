<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Queue Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .parent {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-template-rows: auto auto;
            grid-gap: 5px;
            text-align: center;
        }
        .box {
            padding: 15px;
            border-radius: 8px;
            background: #f8f9fa;
            border: 1px solid #ddd;
        }
        .waiting { grid-area: 1 / 1 / 3 / 2; background-color: lightgray; } /* Waiting Queue spans both rows */
        .counter { background-color: lightblue; }
        .bottom-counter { background-color: lightgreen; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Client Queue Display</h2>
        
        <div class="parent">
            <!-- Waiting Queue -->
            <div class="box waiting">
                <h4>Waiting Queue</h4>
                <ul class="list-group">
                    @php $waitingQueue = $queueEntries->where('status', 'waiting'); @endphp
                    @forelse($waitingQueue as $entry)
                        <li class="list-group-item">#{{ $entry->id }}</li>
                    @empty
                        <br>
                    @endforelse
                </ul>
            </div>

            <!-- Top Row Counters -->
            @foreach (['e-registration', 'oec', 'information_sheet'] as $counter)
                <div class="box counter">
                    <h4>{{ ucfirst(str_replace('_', ' ', $counter)) }}</h4>
                    <ul class="list-group">
                        @php $counterQueue = $queueEntries->where('status', $counter); @endphp
                        @forelse($counterQueue as $entry)
                            <li class="list-group-item">#{{ $entry->id }}</li>
                        @empty
                            <br>
                        @endforelse
                    </ul>
                </div>
            @endforeach

            <!-- Bottom Row Counters -->
            @foreach (['welfare_registration_and_division', 'direct_hire', 'SENA'] as $counter)
                <div class="box bottom-counter">
                    <h4>{{ ucfirst(str_replace('_', ' ', $counter)) }}</h4>
                    <ul class="list-group">
                        @php $counterQueue = $queueEntries->where('status', $counter); @endphp
                        @forelse($counterQueue as $entry)
                            <li class="list-group-item">#{{ $entry->id }}</li>
                        @empty
                            <br>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
