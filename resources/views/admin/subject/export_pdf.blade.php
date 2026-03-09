<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Subjects Export</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; margin-bottom: 5px; }
        .meta { text-align: center; font-size: 10px; color: #888; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; text-align: left; }
        th { background: #4680ff; color: #fff; font-size: 11px; text-transform: uppercase; }
        tr:nth-child(even) { background: #f9f9f9; }
        .badge-active { color: #1a9a5c; font-weight: 600; }
        .badge-inactive { color: #e65100; font-weight: 600; }
    </style>
</head>
<body>
    <h2>Subjects List</h2>
    <p class="meta">Generated on {{ now()->format('d M Y, h:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Subject Name</th>
                <th width="10%">Code</th>
                <th width="18%">Teacher(s)</th>
                <th width="25%">Description</th>
                <th width="10%">Status</th>
                <th width="12%">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $index => $subject)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code ?? '—' }}</td>
                    <td>{{ $subject->teachers->pluck('name')->join(', ') ?: '—' }}</td>
                    <td>{{ $subject->description ?? '—' }}</td>
                    <td>
                        @if($subject->is_active)
                            <span class="badge-active">Active</span>
                        @else
                            <span class="badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $subject->created_at ? $subject->created_at->format('d M Y') : '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #999;">No subjects found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
