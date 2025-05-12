<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Pays extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:255|unique:pays,name')]
    public $name;

    #[validate('min:1|max:3|unique:pays,code')]
    public $code;

    public $paysId;

    public $showModalAdd = false;
    public $showModalEdit = false;

    protected $messages = [
        'name.required' => 'Le nom est requis !',
        'name.min' => 'Le nom doit être de 3 caractères minimum !',
        'name.unique' => 'Le nom existe déjà !',
        'code.required' => 'Le code est requis !',
        'code.min' => 'Le code doit être de 3 caractères minimum !',
        'code.unique' => 'Le code existe déjà !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->code = '';
        $this->resetValidation();
    }

    public function resetform(){
        $this->resetfields();
        $this->paysId = null;
    }

    public function hideAllModals(){
        $this->showModalAdd = false;
        $this->showModalEdit = false;
    }

    public function add_pays(){
        $this->validate();
        $this->dispatch('close-add-modal');

        \App\Models\Pays::create([
            'name' => strtolower($this->name),
            'code' => $this->code,
        ]);

        session()->flash('success', 'Pays ajouté !');
        $this->resetFields();
    }

    public function edit_pays($id){
        $pays = \App\Models\Pays::find($id);
        if ($pays) {
            $this->paysId = $pays->id;
            $this->name = $pays->name;
            $this->code = $pays->code;
        } else {
            session()->flash('danger', 'Pays non trouvé !');
        }
    }
    public function update_pays(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:255', Rule::unique('pays')->ignore($this->paysId)],
            'code' => ['integer', Rule::unique('pays')->ignore($this->paysId)],
        ]);
        $pays = \App\Models\Pays::find($this->paysId);
        if ($pays) {
            $pays->name = strtolower($this->name);
            $pays->code = $this->code;
            $pays->save();

            session()->flash('success', 'Pays mis à jour avec succès !');
            $this->resetfields();
            $this->dispatch('close-update-modal');
        } else {
            session()->flash('danger', 'Pays non trouvé !');
        }
    }

    public function delete_pays($id){
        $pays = \App\Models\Pays::find($id);
        if ($pays) {
            $pays->delete();
            session()->flash('success', 'Pays supprimé avec succès !');
        } else {
            session()->flash('danger', 'Pays non trouvé !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pays',[
            'paysList' => \App\Models\Pays::orderBy('name')->paginate(10),
        ]);
    }
}
