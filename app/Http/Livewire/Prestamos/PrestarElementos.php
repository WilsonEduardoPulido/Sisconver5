<?php

namespace App\Http\Livewire\Prestamos;

use Livewire\Component;
use App\Models\User;
use App\Models\Elemento;

class PrestarElementos extends Component
{


    public $selected_id, $nombre;
    
    public function render()
    {

        $consultaUsuarios = User::all()->where('Estado', "=", 'Activo');
        $consultaElemento = Elemento::all()->where('Estado', "=", 'Disponible');



        return view('livewire.prestamos.prestar-elementos',compact('consultaUsuarios','consultaElemento'));
    }

    

    

        public function cargardatos($id)
	{

        dd($id);
		$record = Elemento::findOrFail($id);
		$this->selected_id = $id;
		$this->nombre = $record->Nombre;
		
	

    }
}
