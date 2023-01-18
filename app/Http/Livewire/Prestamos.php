<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Prestamo;

class Prestamos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Fecha_prestamo, $libros_id, $elementos_id, $usuario_id, $curso_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.prestamos.view', [
            'prestamos' => Prestamo::latest()
						->orWhere('Fecha_prestamo', 'LIKE', $keyWord)
						->orWhere('libros_id', 'LIKE', $keyWord)
						->orWhere('elementos_id', 'LIKE', $keyWord)
						->orWhere('usuario_id', 'LIKE', $keyWord)
						->orWhere('curso_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
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

    public function edit($id)
    {
        $record = Prestamo::findOrFail($id);
        $this->selected_id = $id; 
		$this->Fecha_prestamo = $record-> Fecha_prestamo;
		$this->libros_id = $record-> libros_id;
		$this->elementos_id = $record-> elementos_id;
		$this->usuario_id = $record-> usuario_id;
		$this->curso_id = $record-> curso_id;
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