<?php

namespace App\Livewire;

use App\Models\Categorias;
use Livewire\Component;
use Livewire\WithPagination; // Usar para paginación

// Asegúrate de importar tu modelo
use App\Models\Category; 

class CategoryTable extends Component
{
    use WithPagination;
    
    // 1. Propiedad para búsqueda dinámica
    public $search = '';

    // 2. Método para cambiar estado
    public function toggleStatus($categoryId)
    {
        $category = Categorias::find($categoryId);
        if ($category) {
            $category->update(['activo_c' => !$category->activo_c]);
        }
    }

    public function render()
    {
        // 3. Modifica la consulta para buscar y paginar
        $categorias = Categorias::where('nombre_c', 'like', '%' . $this->search . '%')
                                ->paginate(10); 
                                
        return view('livewire.category-table', [
            'categorias' => $categorias,
        ]);
    }
}