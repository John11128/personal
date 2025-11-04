@extends('welcome')

@section('contenido')
<div class="content-wrapper mt-3">
    <section class="content-header">
        <h1>Reportes del sistema</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                 <div class="mb-3">
        <a href="{{ route('reportes.export.pdf') }}" class="btn btn-danger">Exportar PDF</a>
        <a href="{{ route('reportes.export.excel') }}" class="btn btn-success">Exportar Excel</a>
    </div>
    <form action="{{ route('reportes.import.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <input type="file" name="archivo" class="form-control">
            <button class="btn btn-primary" type="submit">Importar Excel</button>
        </div>
    </form>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Título</th>
                            <th>Usuario</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportes as $r)
                            <tr>
                                <td>{{ $r->fecha_r->format('d/m/Y H:i') }}</td>
                                <td><span class="badge bg-info">{{ ucfirst($r->tipo_r) }}</span></td>
                                <td>{{ $r->titulo_r }}</td>
                                <td>{{ $r->usuario->name ?? 'Sistema' }}</td>
                                <td>
                                    <pre class="text-start">{{ json_encode($r->detalle_r, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $reportes->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
