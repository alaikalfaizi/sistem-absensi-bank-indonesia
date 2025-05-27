<!-- resources/views/logbook/index.blade.php -->
<h1>Logbook</h1>
<a href="{{ route('karyawan.logbook') }}">Isi Logbook</a>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Aktivitas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logbooks as $logbook)
            <tr>
                <td>{{ $logbook->tanggal }}</td>
                <td>{{ $logbook->aktivitas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
