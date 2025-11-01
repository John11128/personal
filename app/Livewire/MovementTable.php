<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\movimientos; // ¡Asegúrate de importar tu modelo!

class MovementTable extends Component
{
    use WithPagination;
    
    // Propiedad para la búsqueda (ejemplo)
    public $search = '';
    
    // Método para una acción específica, como "Deshacer"
    public function undoMovement($movementId)
    {
        // 1. Aquí pondrías la lógica de tu ruta:
        //    - Buscar el movimiento
        //    - Revertir el stock del producto
        //    - Marcar el movimiento como "deshecho" o "inactivo"

        $movement = movimientos::find($movementId);
        if ($movement) {
            // Lógica compleja de inventario, por ahora solo un ejemplo simple:
            $movement->is_undone = true; // O una columna de estado
            $movement->save();
        }

        // Muestra una notificación si usas Livewire 3
        session()->flash('success', '¡Movimiento deshecho exitosamente!');
    }

    public function render()
    {
        // Aplicar filtros a la consulta
        $query = movimientos::query()
            ->with(['producto', 'usuario']) // Cargar las relaciones para evitar N+1
            ->whereHas('producto', function ($q) {
                // Filtra por nombre de producto o por ID del movimiento
                $q->where('nombre_p', 'like', '%' . $this->search . '%');
            })
            ->orWhere('id_m', 'like', '%' . $this->search . '%');

        return view('livewire.movement-table', [
            'movimientos' => $query->paginate(10), // Paginación de Livewire
        ]);
    }
}