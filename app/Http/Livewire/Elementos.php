<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Elemento;
use App\Models\Prestamo;
use App\Models\Categoria;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class Elementos extends Component
{
    use WithPagination;


    public $nombreElemento, $cantidadElemento;
    public $totalCantidad;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $cantidad, $descripcion, $Estado, $categoria_id, $name, $Fecha_Prestamo, $usuario_id, $CantidadPrestar, $prestador_id;

    public function render()
    {
        $consultaUsuarios = User::where('Estado', "=", 'Activo')->select('id', 'name')->get();
        $elementosPrestados = Elemento::where('Estado', "=", 'Prestado')->paginate(10);
        $consulta = Elemento::onlyTrashed()->where('Estado', "=", "Inactivo")->paginate(10);

        $categorias = Categoria::where('Tipo', 'Elementos')->select('id', 'nombre')->get();
        $keyWord = '%' . $this->keyWord . '%';
        return view('livewire.elementos.vistaTabla', [
            'elementos' => Elemento::latest()
                ->orWhere('nombre', 'LIKE', $keyWord)
                ->orWhere('cantidad', 'LIKE', $keyWord)
                ->orWhere('descripcion', 'LIKE', $keyWord)
                ->orWhere('Estado', 'LIKE', $keyWord)
                ->orWhere('categoria_id', 'LIKE', $keyWord)
                ->paginate(10),
        ], compact('categorias', 'consulta', 'elementosPrestados', 'consultaUsuarios'));
    }

    //Funcion Que Limpia los campos Input del formulario
    public function cancelar()
    {
        $this->limpiarCamposInput();
    }



    //Reglas de Validacion 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $rules = [
        'nombre' => 'required',
        'cantidad' => 'required|min:1|numeric',
        'descripcion' => 'required',
        'Estado' => 'required',
        'categoria_id' => 'required',



    ];
    protected $messages = [
        'cantidad.required' => 'La cantidad es requerida',
        'cantidad.min' => 'La cantidad debe tener al menos  un numero mayor a 0',
        'cantidad.numeric' => 'La cantidad debe ser un numero mayor a 0',
    ];


    private function limpiarCamposInput()
    {
        $this->nombre = null;
        $this->cantidad = null;
        $this->descripcion = null;
        $this->Estado = null;
        $this->categoria_id = null;
    }

    public function crearElemento()
    {

        $validateData = $this->validate();

        Elemento::create([
            'nombre' => $this->nombre,
            'cantidad' => $this->cantidad,
            'descripcion' => $this->descripcion,
            'Estado' => $this->Estado,
            'categoria_id' => $this->categoria_id
        ]);

        $this->cancelar();
        $this->dispatchBrowserEvent('cerrar');
        session()->flash('message', 'Elemento creado Con exito.');

    }

    public function editarElemento($id)
    {
        $record = Elemento::findOrFail($id);
        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->cantidad = $record->cantidad;
        $this->descripcion = $record->descripcion;
        $this->Estado = $record->Estado;
        $this->categoria_id = $record->categoria_id;
    }

    public function actualizarElemento()
    {
        $this->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
            'descripcion' => 'required',
            'Estado' => 'required',
            'categoria_id' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Elemento::find($this->selected_id);
            $record->update([
                'nombre' => $this->nombre,
                'cantidad' => $this->cantidad,
                'descripcion' => $this->descripcion,
                'Estado' => $this->Estado,
                'categoria_id' => $this->categoria_id
            ]);

            $this->cancelar();
            $this->dispatchBrowserEvent('cerrar');
            session()->flash('message', 'Elemento Actualizado Con Exito.');
            $this->resetErrorBag();
        }
    }

    //Inactivar Elemento
    public function inactivarElemento($id)
    {


        $elemento = Elemento::find($id);
        if ($elemento->Estado == 'Disponible') {
            $elemento->Estado = 'Inactivo';
            $elemento->save();
            $elemento->delete();
            session()->flash('message', 'Libro Inactivado Con Exito.');
        } else {
            $elemento->Estado = 'Prestado';

            session()->flash('message', 'Libro No Puede Ser Inactivado Porque actualmente esta prestado.');
        }
    }




    //Restaurar Elemento Eliminado

    public function restaurarElemento($id)
    {
        $resElemento = Elemento::onlyTrashed()->where('id', $id)->first();
        if ($resElemento->Estado == 'Inactivo') {
            $resElemento->Estado = 'Disponible';
            $resElemento->save();
        }
        $resElemento->restore();
        session()->flash('message', 'Elemento Restaurado Con Exito.');
    }


    //Elimina El Registro De La Base De Datos De Manera Definitiva
    public function eliminarElementoTotalMente($id)
    {

        $eliElemento = Elemento::onlyTrashed()->where('id', $id)->first();

        $eliElemento->forceDelete();
        session()->flash('message', 'Elemento Eliminado Del Sistema');
    }


    public function cargarDatosPrestamo($id)
    {
        $prestamoC = Elemento::findOrFail($id);
        $prestador = Auth::user()->name;
        $this->name = $prestador;
        $this->prestador_id = Auth::user()->id;
        $this->selected_id = $id;

        $this->nombreElemento = $prestamoC->nombre;
        $this->cantidadElemento = $prestamoC->cantidad;
        $this->descripcion = $prestamoC->descripcion;
        $this->Estado = $prestamoC->Estado;

    }

    
    public function actualizarCantidad(){
    
        $elemento = Elemento::find($this->selected_id);
        $CantidadPrestar = $this->CantidadPrestar;
        $cantidadElemento = $this->cantidadElemento;
        
        $total=$cantidadElemento-$CantidadPrestar;
        $elemento->cantidad=$total;
        

       

        $elemento->update();
        
        
    }
    
    



    public function realizarPrestamo()
    {

        $CantidadPrestar = $this->CantidadPrestar;
        $cantidadElemento = $this->cantidadElemento;
       





        if ($CantidadPrestar > $cantidadElemento) {

            session()->flash('alertaprestamo', 'La cantidad a prestar no puede ser mayor a la cantidad del elemento');
            $this->resetErrorBag();
            $this->resetValidation();
            $this->reset(['CantidadPrestar']);

        } elseif ($CantidadPrestar <= 0) {
            session()->flash('alertaprestamow', 'La cantidad a prestar no puede ser menor a 0');


            $this->resetErrorBag();

        } else {

            

            $this->validate([
                
                'usuario_id' => 'required',
               

            ]);

            if ($this->selected_id) {
                $agregarPrestamo = Prestamo::find($this->selected_id);
                $agregarPrestamo = new Prestamo();
                $agregarPrestamo->CantidadPrestada = $this->CantidadPrestar;
                $agregarPrestamo->elementos_id = $this->selected_id;
                $agregarPrestamo->usuario_id = $this->usuario_id;
                $agregarPrestamo->Fecha_prestamo = $this->Fecha_Prestamo;

                $agregarPrestamo->prestador_id = Auth::user()->id;
$this->actualizarCantidad();
                $agregarPrestamo->save();
                
                session()->flash('alertaprestamow', 'Prestamo Realizado Con Exito.');
                $this->resetErrorBag();
            }
        }


        





    }
    public function limpiarCampos(){


        $this->reset(['CantidadPrestar','usuario_id','Fecha_Prestamo','id_prestador']);
    }

}