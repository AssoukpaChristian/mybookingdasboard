<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Transactions extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:50|unique:transactions,name')]
    public $name;

    #[validate('required|in:Dépense,Recette')]
    public $type;

    public $transactionId;
    public $showModaladd = false;
    public $showModaledit = false;

    protected $messages = [
        'name.required' => 'Le nom est requis !',
        'name.min' => 'Le nom doit être de 3 caractères minimum !',
        'name.max' => 'Le nom doit être de 50 caractères maximum !',
        'name.unique' => 'Le nom doit être unique !',
        'type.required' => 'Le type est requis !',
        'type.in' => 'Le type doit être soit "Dépense" soit "Recette" !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->type = '';
        $this->transactionId = '';
        $this->resetValidation();
    }

    public function updatingName($value){
        $this->name = strtolower($value);
    }

    public function add_transaction(){
        $this->validate();

        \App\Models\Transaction::create([
            'name' => strtolower($this->name),
            'type' => $this->type,
        ]);

        $this->dispatch('close-add-modal');
        session()->flash('success', 'Transaction ajoutée !');
        $this->resetFields();
    }

    public function edit_transaction($id){
        $transaction = \App\Models\Transaction::find($id);
        if ($transaction) {
            $this->transactionId = $transaction->id;
            $this->name = $transaction->name;
            $this->type = $transaction->type;
        } else {
            session()->flash('danger', 'Transaction non trouvée !');
        }
    }

    public function update_transaction(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:50', Rule::unique('transactions')->ignore($this->transactionId)],
            'type' => ['required'],
        ]);
        $transaction = \App\Models\Transaction::find($this->transactionId);
        if ($transaction) {
            $transaction->name = strtolower($this->name);
            $transaction->type = $this->type;
            $transaction->save();

            $this->dispatch('close-update-modal');
            session()->flash('success', 'Transaction mise à jour avec succès !');
            $this->resetfields();
        } else {
            session()->flash('danger', 'Transaction non trouvée !');
        }
    }

    public function delete_transaction($id){
        $transaction = \App\Models\Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            session()->flash('success', 'Transaction supprimée avec succès !');
        } else {
            session()->flash('danger', 'Transaction non trouvée !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.transactions',[
            'transactions' => \App\Models\Transaction::latest()->paginate(10),]);
    }
}
