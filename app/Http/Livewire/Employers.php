<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employer;

class Employers extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $email;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.employers.view', [
            'employers' => Employer::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->email = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'email' => 'required',
        ]);

        Employer::create([ 
			'name' => $this-> name,
			'email' => $this-> email
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Employer Successfully created.');
    }

    public function edit($id)
    {
        $record = Employer::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->email = $record-> email;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'email' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Employer::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'email' => $this-> email
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Employer Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Employer::where('id', $id)->delete();
        }
    }
}