<div
    x-data = "{
        modal : null,
        init(){this.modal = new bootstrap.Modal($refs.modalUpdateBooking)},
        open(){this.modal.show()},
        close(){this.modal.hide()},
    }"
    x-init = "init()"
    @close-add-modal.window = "close()"
    class="modal fade"
    id="modalUpdateBooking"
    x-ref = "modalUpdateBooking"
    wire:ignore.self
    tabindex="-1"
    aria-labelledby="modalUpdateBooking"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier un booking</h1>
                <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$wire.resetfields()"></button>
            </div>

            <div class="modal-body">

                <!-- Registration 4 - Bootstrap Brain Component -->
                <section class="">
                    <div class="container-fluid">
                        <div class="card border-light-subtle shadow-sm">
                            <div class="row g-0">
                                <div class="col-12 col-md-6">
                                    <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/booking.jpg') }}" alt="comptabilité Image">
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <h3 class="text-sm">Modifier un booking</h3>
                                                <h3 class="fs-6 fw-normal text-secondary m-0">Informations booking</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <form wire:submit="update_booking()">

                                        <div class="row gy-3 gy-md-4 overflow-hidden">

                                            <div class="col-12">
                                                <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                                                <select name="client_id" id="client_id" wire:model.blur="client_id" class="form-select" required>
                                                        <option value="">Choisir un client</option>
                                                    @foreach (\App\Models\Client::all() as $client)
                                                        <option value={{ $client->id}}>{{ $client->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('client_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="residence_id" class="form-label">Résidence <span class="text-danger">*</span></label>
                                                <select name="residence_id" id="residence_id" wire:model.blur="residence_id" class="form-select" required>
                                                        <option value="">Choisir une résidence</option>
                                                    @foreach (\App\Models\Residence::all() as $residence)
                                                        <option value={{ $residence->id}}>{{ $residence->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('residence_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12"
                                                wire:ignore {{-- Important pour que Flatpickr garde le contrôle --}}
                                            >
                                                <label for="start" class="form-label">Date début <span class="text-danger">*</span></label>
                                                {{-- <input  id= "start" type="datetime-local" placeholder="Choisir une date" class="form-control datePicker" wire:model.blur="start" required /> --}}
                                                <input  id= "start" type="date" placeholder="Choisir une date" class="form-control datePicker" wire:model.blur="start" required />
                                                @error('start') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12"
                                                wire:ignore {{-- Important pour que Flatpickr garde le contrôle --}}
                                            >
                                                <label for="end" class="form-label">Date fin <span class="text-danger">*</span></label>
                                                {{-- <input  id= "end" type="datetime-local" placeholder="Choisir une date" class="form-control datePicker" wire:model.blur="end" required /> --}}
                                                <input  id= "end" type="date" placeholder="Choisir une date" class="form-control datePicker" wire:model.blur="end" required />
                                                @error('end') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="mode_paiement" class="form-label">Mode de paiement <span class="text-danger">*</span></label>
                                                <select name="mode_paiement" id="mode_paiement" wire:model.blur="mode_paiement" class="form-select" required>
                                                    <option value="">Choisir le mode de paiement</option>
                                                    <option value="carte_bancaire">Carte bancaire</option>
                                                    <option value="chèque">Chèque</option>
                                                    <option value="espèce">Espèce</option>
                                                    <option value="orange_money">Orange money</option>
                                                    <option value="moov_money">Moov money</option>
                                                    <option value="mtn_mobile_money">Mtn mobile money</option>
                                                    <option value="virement">Virement</option>
                                                    <option value="wave">Wave</option>
                                                </select>
                                                @error('mode_paiement') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>


                                            <div class="col-12">
                                                <label for="montant" class="form-label">Prix résidence <span class="text-danger">*</span></label>
                                                <input  id= "montant" type="number" placeholder="montant" class="form-control" wire:model.blur="montant"  disabled required/>
                                                @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="montant_total" class="form-label">Montant à payer <span class="text-danger">*</span></label>
                                                <input  id= "montant_total" type="number" placeholder="Montant total à payer" class="form-control" wire:model.blur="montant_total" disabled/>
                                                @error('montant_total') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn bsb-btn-xl btn-primary mb-2" type="submit">Enregistrer</button>
                                                    <button class="btn bsb-btn-xl btn-secondary" type="button" data-bs-dismiss="modal" @click="$wire.resetfields()">Annuler</button>
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Registration 4 - Bootstrap Brain Component -->

            </div>

        </div>
    </div>

    @script

    @endscript
</div>


