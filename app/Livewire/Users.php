<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;


class Users extends Component
{
    use WithPagination;

    #[validate('required|min:3|max:255|unique:users,name')]
    public $name;

    #[validate('required|email|unique:users,email')]
    public $email;

    #[validate('required|min:8|max:255')]
    public $password;

    #[validate('required|same:password')]
    public $password_confirmation;

    public $userId;

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
        'password.required' => 'Le mot de passe est requis !',
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères !',
        'password_confirmation.required' => 'La confirmation du mot de passe est requise !',
        'password_confirmation.min' => 'La confirmation du mot de passe doit contenir au moins 8 caractères !',
        'password_confirmation.confirmed' => 'Les mots de passe ne correspondent pas !',
        'password_confirmation.same' => 'Les mots de passe ne correspondent pas !',
    ];

    public function resetfields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation();
    }

    public function resetform(){
        $this->resetfields();
        $this->userId = null;
    }

    public function hideAllModals(){
        $this->showModalAdd = false;
        $this->showModalEdit = false;
    }

    public function add_user(){
        $this->validate();
        $this->dispatch('close-add-modal');

        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        session()->flash('success', 'utilisateur créé !');
        $this->resetFields();
    }

    public function edit_user($id){
        $user = \App\Models\User::find($id);
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        } else {
            session()->flash('danger', 'Utilisateur non trouvé !');
        }
    }
    public function update_user(){
        $this->validate([
            'name'  => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->userId)],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
        ]);
        $user = \App\Models\User::find($this->userId);
        if ($user) {
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->save();

            session()->flash('success', 'Utilisateur mis à jour avec succès !');
            $this->resetfields();
            $this->dispatch('close-update-modal');
        } else {
            session()->flash('danger', 'Utilisateur non trouvé !');
        }
    }

    public function delete_user($id){
        $user = \App\Models\User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('success', 'utilisateur supprimé avec succès !');
        } else {
            session()->flash('danger', 'Utilisateur non trouvé !');
        }
    }

    public function mount()
    {
        $this->resetfields();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users',[
            'users' => \App\Models\User::latest()->paginate(10),
        ]);
    }
}
