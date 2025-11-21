<?php
// index.blade.php versi tanpa JavaScript
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Time Flip-Event Countdown</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">Time Flip</h1>

    <!-- Alert jika sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol buka modal -->
    <div class="text-end mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">
            + Create Event
        </button>
    </div>

    <!-- List Event -->
    <div class="row">
        @forelse ($events as $event)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h5>{{ $event->name }}</h5>
                    <p class="text-muted">{{ $event->event_date }}</p>

                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete event?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center font-normal text-blue-500 ">Belum ada event.</p>
        @endforelse
    </div>
</div>

<!-- Modal Create Event -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Event Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Event Date</label>
                        <input type="date" name="event_date" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Start Countdown</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>