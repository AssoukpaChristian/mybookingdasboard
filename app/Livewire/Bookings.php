<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Carbon\Carbon;
use App\Models\Caisse;

class Bookings extends Component
{
    use WithPagination;

    #[validate('required|exists:clients,id')]
    public $client_id;

    #[validate('required|exists:residences,id')]
    public $residence_id;

    #[validate('required|integer')]
    public $montant=0;

    #[validate('required')]
    public $mode_paiement;

    #[validate('required')]
    public $start;

    #[validate('required')]
    public $end;

    public $montant_total;

    public $reliquat;

    #[validate('numeric|lte:montant_total')]
    public $montant_paye;
    #[validate('numeric|lte:reliquat')]
    public $paiement;


    public $status;

    public $mois;
    public $annees;
    public $search_mois;
    public $search_annee;

    public $bookingId;
    public $showModaladd = false;
    public $showModaledit = false;
    public $caisse;
    public $calendarbookings;

    // protected $rules = [
    //     'montant_paye' => 'required|numeric|lte:montant_total',
    //     'montant_max' => 'numeric|lte:reliquat',
    // ];

    protected $messages = [
        'client_id.required'=>'Un client est requis',
        'client_id.exists' => 'Le client doit exister !',
        'residence_id.required' => 'La résidence est requise !',
        'residence_id.exists' => 'La résidence doit exister !',
        'montant.required' => 'Le montant est requis !',
        'montant.integer' => 'Le montant doit être un entier !',
        'mode_paiement.required' => 'Le mode de paiement est requis !',
        'start.required' => 'La date de début est requise !',
        'end.required' => 'La date de fin est requise !',
        'montant_paye.lte' => 'Ce montant doit être inférieur ou égale au Montant total à payer',
        'paiement.lte' => 'Ce montant doit être inférieur ou égale au Reliquat',
    ];

    public function mount()
    {
        $this->resetfields();
        $this->annees = range(2025,2050);

        for ($i = 1; $i <= 12; $i++) {
            $this->mois[$i] = Carbon::createFromDate(null, $i, 1)->locale('fr')->isoFormat('MMMM');
        }

        $this->search_annee = Carbon::now()->year;
        $this->search_mois = Carbon::now()->month;
        $this->update_caisse();

    }

    public function updatedMontant() {
        $startDate = Carbon::parse($this->start, 'Africa/Abidjan');
        $endDate = Carbon::parse($this->end, 'Africa/Abidjan');
        $diffInDays = $startDate->diffInDays($endDate);

        $total = intval($this->montant) * intval($diffInDays);
        $this->montant_total = $total;
    }
    public function updatedStart() {
        $startDate = Carbon::parse($this->start, 'Africa/Abidjan');
        $endDate = Carbon::parse($this->end, 'Africa/Abidjan');
        $diffInDays = $startDate->diffInDays($endDate);

        $total = intval($this->montant) * intval($diffInDays);
        $this->montant_total = $total;
    }
    public function updatedEnd() {
        $startDate = Carbon::parse($this->start, 'Africa/Abidjan');
        $endDate = Carbon::parse($this->end, 'Africa/Abidjan');
        $diffInDays = $startDate->diffInDays($endDate);

        $total = intval($this->montant) * intval($diffInDays);
        $this->montant_total = $total;
    }

    public function updatingSearchMois() {
        $this->resetPage();
    }

    public function updatingSearchAnnee() {
        $this->resetPage();
    }

    public function update_caisse(){
        $this->caisse = \App\Models\Caisse::first()->montant ?? 0;
    }

    public function resetfields(){
        $this->client_id = '';
        $this->residence_id = '';
        $this->montant = '';
        $this->montant_total = '';
        $this->mode_paiement = '';
        $this->montant_paye = '';
        $this->reliquat = '';
        $this->status = '';
        $this->start = '';
        $this->end = '';
        $this->bookingId = '';
        $this->paiement = '';
        $this->resetValidation();
    }

    public function add_booking(){
        $this->validate();

        // Caisse::crediter($this->montant);
        $book = new \App\Models\Booking();
        $book->client_id =  $this->client_id;
        $book->residence_id =  $this->residence_id;
        $book->mode_paiement =  $this->mode_paiement;
        $book->montant =  $this->montant;

        $startDate = Carbon::parse($this->start, 'Africa/Abidjan');
        $endDate = Carbon::parse($this->end, 'Africa/Abidjan');
        $diffInDays = $startDate->diffInDays($endDate);
        $total = intval($this->montant) * $diffInDays;
        $book->montant_total =  $total;

        $book->start =  $this->start;
        $book->end =  $this->end;

        $reste = $total - $this->montant_paye;
        $book->reliquat = $reste;
        if ($reste > 0){
            $book->status = 'non soldé';
        }elseif ($reste == 0) {
            $book->status = 'soldé';
        }

        try {

            if($this->montant_paye>0){
                $op = \App\Models\Operation::create([
                    'transaction_id' => 5,
                    'residence_id' => $this->residence_id,
                    'montant' => $this->montant_paye,
                    'mode_paiement' => $this->mode_paiement,
                    'operationdate' => Carbon::now(),
                    'periode' => "",
                ]);
                $book->operation_id = $op->id;
                $book->save();
                Caisse::crediter($this->montant_paye);
            }
        } catch (\Throwable $th) {
            session()->flash('danger', $th->getMessage());
        }

        $this->dispatch('close-add-modal');
        session()->flash('success', 'Booking ajouté !');
        $this->resetFields();

    }

    public function edit_booking($id){
        $this->resetFields();
        $booking = \App\Models\Booking::find($id);
        if ($booking) {
            $this->bookingId = $booking->id;
            $this->start = $booking->start;
            $this->end = $booking->end;
            $this->client_id = $booking->client_id;
            $this->residence_id = $booking->residence_id;
            $this->mode_paiement = $booking->mode_paiement;
            $this->montant = $booking->montant;
            $this->montant_total = $booking->montant_total;
            $this->reliquat = $booking->reliquat;
        } else {
            session()->flash('danger', 'Booking non trouvé !');
        }
    }

    public function update_booking(){
        $this->validate();
        $booking = \App\Models\Booking::find($this->bookingId);
        if ($booking) {
            $booking->start = $this->start;
            // $booking->end = $this->start;
            $booking->save();

            $this->dispatch('close-update-modal');
            session()->flash('success', 'Booking mise à jour avec succès !');
            $this->resetfields();
        } else {
            session()->flash('danger', 'Booking non trouvée !');
        }
    }



    public function payer_booking(){
        $this->validate();
        $booking = \App\Models\Booking::find($this->bookingId);
        if ($booking) {
            $booking->reliquat = $booking->reliquat - $this->paiement;
            if($booking->reliquat == 0){
                $booking->status = "soldé";
            }
            // $booking->end = $this->start;
            $booking->save();

            $this->dispatch('close-paye-modal');
            session()->flash('success', 'Booking mise à jour avec succès !');
            $this->resetfields();
        } else {
            session()->flash('danger', 'Booking non trouvé !');
        }
    }

    public function delete_booking($id){
        $booking = \App\Models\Booking::find($id);
        $caisse = \App\Models\Caisse::initializeMontant()->montant;
        if ($booking) {
            $op = \App\Models\Operation::find($booking->operation_id);
            $booking->delete();

            if($op){
                if($op->transaction->type == "Dépense"){
                    \App\Models\Caisse::crediter($op->montant);
                }elseif($op->transaction->type == "Recette"){
                    \App\Models\Caisse::debiter($op->montant);
                }
                $op->delete();
            }

            session()->flash('success', 'Booking supprimé avec succès !');
        } else {
            session()->flash('danger', 'Booking non trouvé !');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->update_caisse();

        $query = \App\Models\Booking::query();

        // Filtre par mois
        if ($this->search_mois) {
            $query->whereMonth('start', $this->search_mois);
        }

        // Filtre par année
        if ($this->search_annee) {
            $query->whereYear('start', $this->search_annee);
        }

        return view('livewire.bookings', [
            'bookings' => $query->latest()->paginate(10),
        ]);

    }
}
