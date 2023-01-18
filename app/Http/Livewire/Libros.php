<?php

namespace App\Http\Livewire;

use App\Models\Libro;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithPagination;

class Libros extends Component
{
	use WithPagination;

public $libro;
	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $Nombre, $Autor, $Editorial, $Edicion, $Descripcion, $Estado, $categoria_id;

	public function render()
	{
		$consulta = Libro::onlyTrashed()
			->orWhere('Estado', "=", 'Inactivo')
			->paginate(10);
		$categorias = Categoria::where('Tipo', "=", 'Libros')->where('Estado', "=", 'Activa')->select('id', 'nombre')->get();
		$keyWord = '%' . $this->keyWord . '%';
		return view('livewire.libros.view', [
			'libros' => Libro::latest()
				->orWhere('Nombre', 'LIKE', $keyWord)
				->orWhere('Autor', 'LIKE', $keyWord)
				->orWhere('Editorial', 'LIKE', $keyWord)
				->orWhere('Edicion', 'LIKE', $keyWord)
				->orWhere('Descripcion', 'LIKE', $keyWord)
				->orWhere('Estado', 'LIKE', $keyWord)
				->orWhere('nombre', 'LIKE', $keyWord)
				->paginate(10),
		], compact('categorias','consulta'));
	}

	public function cancel()
	{
		$this->resetInput();
		$this->resetValidation();
	}
	public function M()
	{

		$this->dispatchBrowserEvent('openModal');
	}
	private function resetInput()
	{
		$this->Nombre = null;
		$this->Autor = null;
		$this->Editorial = null;
		$this->Edicion = null;
		$this->Descripcion = null;
		$this->Estado = null;
		$this->categoria_id = null;
	}

	public function store()
	{
		$this->validate([
			'Nombre' => 'required',
			'Autor' => 'required',
			'Editorial' => 'required',
			'Edicion' => 'required',
			'Estado' => 'required',
			'categoria_id' => 'required',
		]);

		Libro::create([
			'Nombre' => $this->Nombre,
			'Autor' => $this->Autor,
			'Editorial' => $this->Editorial,
			'Edicion' => $this->Edicion,
			'Descripcion' => $this->Descripcion,
			'Estado' => $this->Estado,
			'categoria_id' => $this->categoria_id
		]);

		$this->resetInput();
		$this->dispatchBrowserEvent('cerrar');
		session()->flash('message', 'Libro Creado Con Exito.');
	}




	public function presarLibro($id)
	{




$libro = Libro::find($id);

		if ($libro->Estado == 'Disponible') {
			$libro->Estado = 'Prestado';
			$libro->save();

			session()->flash('message', 'Libro Prestado Con Exito.');
		} elseif ($libro->Estado == 'Inactivo') {

			session()->flash('message', 'Libro No esta Disponible Con Exito.');


		} else {
			session()->flash('message', 'El Libro No Esta Disponible.');
		}

	}




	public function edit($id)
	{
		$record = Libro::findOrFail($id);
		$this->selected_id = $id;
		$this->Nombre = $record->Nombre;
		$this->Autor = $record->Autor;
		$this->Editorial = $record->Editorial;
		$this->Edicion = $record->Edicion;
		$this->Descripcion = $record->Descripcion;
		$this->Estado = $record->Estado;
		$this->categoria_id = $record->categoria_id;
	}

	public function update()
	{
		$this->validate([
			'Nombre' => 'required',
			'Autor' => 'required',
			'Editorial' => 'required',
			'Edicion' => 'required',
			'Estado' => 'required',
			'categoria_id' => 'required',
		]);

		if ($this->selected_id) {
			$record = Libro::find($this->selected_id);
			$record->update([
				'Nombre' => $this->Nombre,
				'Autor' => $this->Autor,
				'Editorial' => $this->Editorial,
				'Edicion' => $this->Edicion,
				'Descripcion' => $this->Descripcion,
				'Estado' => $this->Estado,
				'categoria_id' => $this->categoria_id
			]);

			$this->resetInput();
			$this->dispatchBrowserEvent('cerrar');
			session()->flash('message', 'Libro Actualizado Con Exito.');
		}
	}

	public function destroy($id)
	{


		$libro = Libro::find($id);
        if($libro->Estado == 'Disponible'){
            $libro->Estado = 'Inactivo';
            $libro->save();
            $libro->delete();
            session()->flash('message', 'Libro Inactivado Con Exito.');
	}else{
$libro->Estado = 'Prestado';

session()->flash('message', 'Libro No Puede Ser Inactivado Porque actualmente esta prestado.');
	}
	}




	//Restaurar Libro Eliminada

    public function restaurarLibro($id){
        $resLibro =Libro::onlyTrashed()->where('id', $id)->first();
        if($resLibro->Estado == 'Inactivo'){
            $resLibro->Estado = 'Disponible';
            $resLibro->save();
        }
        $resLibro->restore();
        session()->flash('message', 'Libro Restaurado Con Exito.');
    }
    
    
        //Elimina El Registro De La Base De Datos De Manera Definitiva
    public function eliminarLibroTotalMente($id){
    
    $eliLibro =Libro::onlyTrashed()->where('id', $id)->first();

    $eliLibro->forceDelete();
    session()->flash('message','Libro Eliminado Del Sistema');
    }
 }