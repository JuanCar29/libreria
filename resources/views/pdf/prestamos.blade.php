<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Préstamos Devueltos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 6px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        td {
            border: 1px solid #ccc;
            padding: 4px;
            text-align: left;
            font-size: 12px;
        }

        .page-break {
            page-break-after: always;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .date-range {
            text-align: center;
            margin-bottom: 15px;
        }

        h1 {
            text-align: center;
            margin-bottom: 15px;
        }

        p {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    @foreach ($loanPages as $index => $pageLoans)
        <h1>Reporte de Préstamos</h1>
        <div class="date-range">
            Desde: {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }}
            hasta: {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libro</th>
                    <th>Socio</th>
                    <th>Prestado</th>
                    <th>Devuelto</th>
                    <th>Días</th>
                    <th>Multa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pageLoans as $prestamo)
                    <tr>
                        <td>{{ $prestamo->id }}</td>
                        <td>{{ $prestamo->libro->titulo ?? '—' }}</td>
                        <td>{{ $prestamo->socio->nombre ?? '—' }}</td>
                        <td>{{ $prestamo->fecha_prestamo?->format('d/m/Y') }}</td>
                        <td>{{ $prestamo->fecha_devolucion_real?->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $prestamo->dias_transcurridos }}</td>
                        <td class="text-center">
                            {{ $prestamo->sancion ? number_format($prestamo->sancion, 2, ',', '.') . ' €' : '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Página {{ $loop->index + 1 }}</p>
        {{-- Salto de página después de cada bloque, excepto en el último --}}
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>
