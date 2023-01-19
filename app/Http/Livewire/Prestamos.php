<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Elemento;
use App\Models\Prestamo;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\User;

class Prestamos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $buscadorPrestamos, $Fecha_prestamo, $libros_id, $elementos_id, $usuario_id, $curso_id,$CantidadPrestada,$ArticuloPrestado;
    public $usuarioDeudor;
    public function render()

    {

        $consultaUsuariosPrestamos =User::pluck('name','id')->where('Esatado','Activo');
		$buscadorPrestamos = '%'.$this->buscadorPrestamos .'%';
        return view('livewire.prestamos.vistaprestamos', [
            'prestamos' => Prestamo::latest()
						->orWhere('Fecha_prestamo', 'LIKE', $buscadorPrestamos)
						->orWhere('libros_id', 'LIKE', $buscadorPrestamos)
						->orWhere('elementos_id', 'LIKE', $buscadorPrestamos)
						->orWhere('usuario_id', 'LIKE', $buscadorPrestamos)
						->orWhere('curso_id', 'LIKE', $buscadorPrestamos)
						->paginate(10),
        ],compact('consultaUsuariosPrestamos'));
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->Fecha_prestamo = null;
		$this->libros_id = null;
		$this->elementos_id = null;
		$this->usuario_id = null;
		$this->curso_id = null;
    }

    public function store()
    {
        $this->validate([
		'Fecha_prestamo' => 'required',
		'libros_id' => 'required',
		'elementos_id' => 'required',
		'usuario_id' => 'required',
		'curso_id' => 'required',
        ]);

        Prestamo::create([ 
			'Fecha_prestamo' => $this-> Fecha_prestamo,
			'libros_id' => $this-> libros_id,
			'elementos_id' => $this-> elementos_id,
			'usuario_id' => $this-> usuario_id,
			'curso_id' => $this-> curso_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Prestamo Successfully created.');
    }

    public function editarPrestamo($id)
    {
        $editarPrestamo = Prestamo::findOrFail($id);
        
       $elemento=Elemento::findOrFail($editarPrestamo->elementos_id);
       $usuario=User::findOrFail($editarPrestamo->usuario_id);

        
       
       $this->usuarioDeudor=$usuario->name;
         $this->CantidadPrestada=$editarPrestamo->CantidadPrestada;
$this->ArticuloPrestado=$elemento->nombre;
        $this->selected_id = $id; 
		$this->Fecha_prestamo = $editarPrestamo-> Fecha_prestamo;
		
        $this->usuario_id = $editarPrestamo-> usuario_id;
        $this->elementos_id = $editarPrestamo-> nombre;
		
    }

    public function update()
    {
        $this->validate([
		'Fecha_prestamo' => 'required',
		'libros_id' => 'required',
		'elementos_id' => 'required',
		'usuario_id' => 'required',
		'curso_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Prestamo::find($this->selected_id);
            $record->update([ 
			'Fecha_prestamo' => $this-> Fecha_prestamo,
			'libros_id' => $this-> libros_id,
			'elementos_id' => $this-> elementos_id,
			'usuario_id' => $this-> usuario_id,
			'curso_id' => $this-> curso_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Prestamo Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Prestamo::where('id', $id)->delete();
        }
    }
}