<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 40px;
        }
        .highlight {
            background-color: #d1e7dd !important;
            font-weight: bold;
        }
        .form-inline .form-control {
            width: auto;
            margin-right: 10px;
        }
        .leaderboard-card {
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4 text-center">🏆 Leaderboard List</h2>

    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <form method="POST" action="{{ route('rank.recalculate') }}">
            @csrf
            <button type="submit" class="btn btn-warning">🔁 Recalculate</button>
        </form>

        <form method="GET" action="{{ route('rank.index') }}" class="d-flex flex-wrap align-items-center gap-2">
            <label for="filter" class="form-label m-0">🔍 User ID:</label>
            <input type="text" name="filter" class="form-control" value="{{ request('filter') }}" />
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <form method="GET" action="{{ route('rank.index') }}" class="d-flex flex-wrap align-items-center gap-2">
            <label for="sort_by" class="form-label m-0">📅 Sort by:</label>
            <select name="sort_by" class="form-select">
                <option value="">--</option>
                <option value="day" {{ $sort_by === 'day' ? 'selected' : '' }}>Day</option>
                <option value="month" {{ $sort_by === 'month' ? 'selected' : '' }}>Month</option>
                <option value="year" {{ $sort_by === 'year' ? 'selected' : '' }}>Year</option>
            </select>
            <button type="submit" class="btn btn-success">Sort</button>
        </form>
    </div>

    <div class="card leaderboard-card">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="{{ $filter == $user->id ? 'highlight' : '' }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $pointsMap[$user->id] }}</td>
                            <td>#{{ $user->rank }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
