<?php

namespace App\Http\Livewire;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithPagination;

class Libros extends Component
{
	use WithPagination;

public $libro , $nombreBibliotecario, $nombreLibro, $nombreUsuario, $cantidadDisponible, $cantidadPrestamo ,$cantidaPrestarLibro;
	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $Nombre, $Autor, $Editorial, $Edicion, $Descripcion, $Estado, $categoria_id;

	public function render()
	{
        $consultaUsuariosLibros = User::where('Estado','=','Activo')->select('id','name')->get();
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
		], compact('categorias','consulta','consultaUsuariosLibros'));
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
        $this->CantidadLibros = $record->CantidadLibros;
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
            'CantidadLibros' => 'min:1,'
        ]);

        if ($this->selected_id) {
            $record = Libro::find($this->selected_id);
            $record->Nombre = $this->Nombre;
            $record->Autor = $this->Autor;
            $record->Editorial = $this->Editorial;
            $record->Edicion = $this->Edicion;
            $record->Descripcion = $this->Descripcion;
            $record->Estado = $this->Estado;
            $record->categoria_id = $this->categoria_id;
            $record->CantidadLibros = $this->CantidadLibros;
            $this->ValidarCantidad();
            $record->save();
            $this->resetInput();
            $this->dispatchBrowserEvent('cerrar');
            session()->flash('message', 'Libro Actualizado Con Exito.');
        }
    }

    public function ValidarCantidad(){
        $cantidad = $this->CantidadLibros;

        if ($cantidad <= 0){
            session()->flash('message', 'La cantidad no puede ser menor a 0.');
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

    public function CargarDatosPrestamosLibros ($id){
        $prestamoLibrof = Libro::findOrFail($id);
        $prestadorLibro = Auth::user()->name;
        $this->nombreBibliotecario=$prestadorLibro;
        $this->prestador_id = Auth::user()->id;
        $this->selected_id = $id;
        $this->nombreLibro = $prestamoLibrof -> Nombre;
        $this->cantidadDisponible = $prestamoLibrof -> CantidadLibros;

    }

    public function ActualizarCantidadLibros (){
        $librof = Libro::find($this->selected_id);
        $cantidaPrestarLibro = $this->cantidadPrestamo;
        $cantidadDisponible = $this-> cantidadDisponible;
        $Total = $cantidadDisponible-$cantidaPrestarLibro;
        $librof->CantidadLibros = $Total;
        $librof->update();
    }

    public function RealizarPrestamoLibro(){
        $cantidaPrestarLibro = $this->cantidadPrestamo;
        $cantidadDisponible = $this-> cantidadDisponible;
        if($cantidaPrestarLibro > $cantidadDisponible){
            session()->flash('AlertaPrestamoLibro','La cantidad aprestar no puede ser mayor a la cantidad de libros disponbles');
        }elseif ($cantidaPrestarLibro <= 0){
            session()->flash('AlertaPrestamoLibro','La cantidad aprestar tiene que ser mayor a 0');
        }else{
            if ($this->selected_id){
                $PrestamoRealizado = Prestamo::find($this->selected_id);
                $PrestamoRealizado = new Prestamo();
                $PrestamoRealizado->CantidadPrestada = $this->cantidadPrestamo;
                $PrestamoRealizado->prestador_id = Auth::user()->id;
                $PrestamoRealizado->libros_id = $this->selected_id;
                $PrestamoRealizado->usuario_id = $this->nombreUsuario;
                $this->ActualizarCantidadLibros();
                $PrestamoRealizado->save();
                session()->flash('AlertaPrestamoLibro','Prestamo Realizado con Exito');
                $this->ResetearCantidades();
            }
        }

    }

    public function ResetearCantidades(){

        $this->reset(['cantidadPrestamo','id','selected_id']);
    }


 }
