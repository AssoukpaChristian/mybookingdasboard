<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Carbon\Carbon;
use App\Models\Caisse;
use PhpParser\Node\Stmt\TryCatch;

class Operations extends Component
{
    use WithPagination;

    #[validate('required|exists:transactions,id')]
    public $transaction_id;

    #[validate('required|integer')]
    public $montant;

    #[validate('required')]
    public $mode_paiement;

    #[validate('required')]
    public $operationdate;

    public $periode;
    public $moisAnnee;
    public $mois;
    public $annees;
    public $search_mois;
    public $search_annee;
    public $residence_id;
    public $operationId;
    public $showModaladd = false;
    public $showModaledit = false;
    public $caisse;

    protected $messages = [
        'transaction_id.required' => 'La transaction est requise !',
        'transaction_id.exists' => 'La transaction doit exister !',
        'montant.required' => 'Le montant est requis !',
        'montant.integer' => 'Le montant doit être un entier !',
        'mode_paiement.required' => 'Le mode de paiement est requis !',
        'operationdate.required' => 'La date de l\'opération est requise !',
        'operationdate.date' => 'La date de l\'opération doit être une date valide !',
    ];

    public function mount()
    {
        $this->resetfields();
        $this->residence_id = null;
        $this->annees = range(2025,2050);

        for ($i = 1; $i <= 12; $i++) {
            $this->mois[$i] = Carbon::createFromDate(null, $i, 1)->locale('fr')->isoFormat('MMMM');
        }

        $this->search_annee = Carbon::now()->year;
        $this->search_mois = Carbon::now()->month;
        $this->update_caisse();
    }

    public function update_caisse(){
        $this->caisse = \App\Models\Caisse::first()->montant ?? 0;
    }

    public function resetfields(){
        $this->transaction_id = '';
        $this->residence_id = '';
        $this->montant = '';
        $this->mode_paiement = '';
        $this->operationdate = '';
        $this->periode = '';
        $this->operationId = '';
        $this->resetValidation();
    }

    public function add_operation(){
        $this->validate();

        if($this->residence_id != null && $this->residence_id != ""){
            $residence = $this->residence_id;
        }else{
            $residence = null;
        }

        $type = \App\Models\Transaction::find($this->transaction_id)->type;
        if($type==="Dépense"){
            try {
                Caisse::debiter($this->montant);
                \App\Models\Operation::create([
                    'transaction_id' => $this->transaction_id,
                    'residence_id' => $residence,
                    'montant' => $this->montant,
                    'mode_paiement' => $this->mode_paiement,
                    'operationdate' => $this->operationdate,
                    'periode' => $this->periode,
                ]);

                $this->dispatch('close-add-modal');
                session()->flash('success', 'Opération ajoutée !');
                $this->resetFields();

            } catch (\Throwable $th) {
                session()->flash('danger', $th->getMessage());
                $this->dispatch('close-add-modal');
            }
        }else{
            Caisse::crediter($this->montant);
            \App\Models\Operation::create([
                'transaction_id' => $this->transaction_id,
                'residence_id' => $residence,
                'montant' => $this->montant,
                'mode_paiement' => $this->mode_paiement,
                'operationdate' => $this->operationdate,
                'periode' => $this->periode,
            ]);

            $this->dispatch('close-add-modal');
            session()->flash('success', 'Opération ajoutée !');
            $this->resetFields();
        }

    }

    public function updatedOperationdate($value){
        $this->moisAnnee = Carbon::parse($value)->locale('fr')->translatedFormat('F-Y');
    }

    public function updatingSearchMois() {
        $this->resetPage();
    }

    public function updatingSearchAnnee() {
        $this->resetPage();
    }


    public function edit_operation($id){
        $operation = \App\Models\Operation::find($id);
        if ($operation) {
            $this->operationId = $operation->id;
            $this->transaction_id = $operation->transaction_id;
            $this->residence_id = $operation->residence_id;
            $this->montant = $operation->montant;
            $this->mode_paiement = $operation->mode_paiement;
            $this->operationdate = $operation->operationdate;
            $this->periode = $operation->periode;
        } else {
            session()->flash('danger', 'Opération non trouvée !');
        }
    }

    public function update_operation(){
        $this->validate();
        $operation = \App\Models\Operation::find($this->operationId);
        if ($operation) {
            $operation->transaction_id = $this->transaction_id;
            $operation->residence_id = $this->residence_id;
            $operation->montant = $this->montant;
            $operation->mode_paiement = $this->mode_paiement;
            $operation->operationdate = $this->operationdate;
            $operation->transaction_id = $this->transaction_id;
            $operation->periode = $this->periode;
            $operation->save();

            $this->dispatch('close-update-modal');
            session()->flash('success', 'Operation mise à jour avec succès !');
            $this->resetfields();
        } else {
            session()->flash('danger', 'Operation non trouvée !');
        }
    }

    public function delete_operation($id){
        $operation = \App\Models\Operation::find($id);
        $caisse = \App\Models\Caisse::initializeMontant()->montant;
        if ($operation) {
            $operation->delete();
            if($operation->transaction->type == "Dépense"){
                \App\Models\Caisse::crediter($operation->montant);
            }elseif($operation->transaction->type == "Recette"){
                \App\Models\Caisse::debiter($operation->montant);
            }
            session()->flash('success', 'Operation supprimée avec succès !');
        } else {
            session()->flash('danger', 'Operation non trouvée !');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->update_caisse();

        $query = \App\Models\Operation::query();

        // Filtre par mois
        if ($this->search_mois) {
            $query->whereMonth('operationdate', $this->search_mois);
        }

        // Filtre par année
        if ($this->search_annee) {
            $query->whereYear('operationdate', $this->search_annee);
        }

        // 2) Pagination et passage à la vue
        return view('livewire.operations', [
            'operations' => $query->latest()->paginate(10),
        ]);

    }
}
