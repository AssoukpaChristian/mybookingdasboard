<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Clients extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:255|unique:clients,name')]
    public $name;

    #[validate('required|email|unique:clients,email')]
    public $email;

    #[validate('required|min:8|max:255')]
    public $contact;

    #[validate('required')]
    public $pays;

    public $clientId;
    public $paysList;

    public $showModalAdd = false;
    public $showModalEdit = false;

    protected $messages = [
        'name.required' => 'Le nom est requis !',
        'name.min' => 'Le nom doit être de 3 caractères minimum !',
        'name.unique' => 'Le nom existe déjà !',
        'email.required' => "L'Adresse email est requise !",
        'email.email' => 'L\'Adresse email doit être une adresse valide !',
        'email.unique' => "L'Adresse email existe déjà !",
        'email.max' => "L'Adresse email ne doit pas dépasser 255 caractères !",
        'contact.required' => 'Le contact est requis !',
        'contact.min' => 'Le contact doit être de 8 caractères minimum !',
        'contact.max' => 'Le contact ne doit pas dépasser 255 caractères !',
        'pays.required' => 'Le pays est requis !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->email = '';
        $this->contact = '';
        $this->pays = '';
        $this->resetValidation();
    }

    public function resetform(){
        $this->resetfields();
        $this->clientId = null;
    }

    public function hideAllModals(){
        $this->showModalAdd = false;
        $this->showModalEdit = false;
    }

    public function add_client(){
        $this->validate();
        $this->dispatch('close-add-modal');

        \App\Models\Client::create([
            'name' => $this->name,
            'contact' => $this->contact,
            'email' => $this->email,
            'pays_id' => $this->pays,
        ]);

        session()->flash('success', 'Client créé !');
        $this->resetFields();
    }

    public function edit_client($id){
        $client = \App\Models\Client::find($id);
        if ($client) {
            $this->clientId = $client->id;
            $this->name = $client->name;
            $this->contact = $client->contact;
            $this->email = $client->email;
            $this->pays = $client->pays_id;
        } else {
            session()->flash('danger', 'Client non trouvé !');
        }
    }
    
    public function update_client(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:255', Rule::unique('clients')->ignore($this->clientId)],
            'email' => ['required', 'email', Rule::unique('clients')->ignore($this->clientId)],
            'contact' => ['required', 'min:8'],
            'pays' => ['required', 'exists:pays,id'],
        ]);
        $client = \App\Models\Client::find($this->clientId);
        if ($client) {
            $client->name = $this->name;
            $client->email = $this->email;
            $client->contact = $this->contact;
            $client->pays_id = $this->pays;
            $client->save();

            session()->flash('success', 'Utilisateur mis à jour avec succès !');
            $this->resetfields();
            $this->dispatch('close-update-modal');
        } else {
            session()->flash('danger', 'Utilisateur non trouvé !');
        }
    }

    public function delete_client($id){
        $client = \App\Models\Client::find($id);
        if ($client) {
            $client->delete();
            session()->flash('success', 'Client supprimé avec succès !');
        } else {
            session()->flash('danger', 'Client non trouvé !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.clients',[
            'clients' => \App\Models\Client::latest()->paginate(10),]);
    }
}
