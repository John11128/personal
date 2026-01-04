<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reportes del sistema</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; color: #222; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .meta { text-align: center; font-size: 11px; color: #555; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #bbb; padding: 6px 8px; vertical-align: top; }
        th { background: #f0f0f0; text-align: left; }
        .detalle { white-space: pre-wrap; font-family: monospace; font-size: 10px; }
        .small { font-size: 10px; color: #666; }
        footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reportes del sistema</h1>
    </div>
    <div class="meta">
        Generado: {{ now()->format('d/m/Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:12%">Fecha</th>
                <th style="width:10%">Tipo</th>
                <th style="width:20%">Título</th>
                <th style="width:18%">Usuario</th>
                <th style="width:40%">Detalle</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reportes as $r)
                <tr>
                    <td>{{ 
                        // Asegurar que fecha_r es instancia de fecha
                        isset($r->fecha_r) ? $r->fecha_r->format('d/m/Y H:i') : ''
                    }}</td>
                    <td>{{ ucfirst($r->tipo_r) }}</td>
                    <td>{{ $r->titulo_r }}</td>
                    <td>{{ $r->usuario->name ?? 'Sistema' }}</td>
                    <td class="detalle">{!! nl2br(e(json_encode($r->detalle_r, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="small">No hay reportes para mostrar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer>Generado por SisInvPer - {{ now()->format('d/m/Y') }}</footer>
</body>
</html>