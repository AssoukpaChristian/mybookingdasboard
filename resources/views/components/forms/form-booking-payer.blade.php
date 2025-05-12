<div
    x-data = "{
        modal : null,
        init(){this.modal = new bootstrap.Modal($refs.modalPayerBooking)},
        open(){this.modal.show()},
        close(){this.modal.hide()},
    }"
    x-init = "init()"
    @close-paye-modal.window = "close()"
    class="modal fade"
    id="modalPayerBooking"
    x-ref = "modalPayerBooking"
    wire:ignore.self
    tabindex="-1"
    aria-labelledby="modalPayerBooking"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Effectuer un paiement</h1>
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
                                                    <h3 class="text-sm">Enregistrer un paiement booking</h3>
                                                    <h3 class="fs-6 fw-normal text-secondary m-0">Informations booking</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <form wire:submit="payer_booking()">

                                            <div class="col-12">
                                                <label for="reliquat" class="form-label">Reste à payer<span class="text-danger">*</span></label>
                                                <input type="number" wire:model.blur="reliquat" class="form-control" name="reliquat" id="reliquat" placeholder="reliquat" disabled />
                                                @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
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
                                                <label for="paiement" class="form-label">Paiement <span class="text-danger">*</span></label>
                                                <input  id= "paiement" type="number" placeholder="Paiement" class="form-control" wire:model.blur="paiement"  style="font-size: 20px"/>
                                                @error('paiement') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="d-grid">
                                                    <button class="btn bsb-btn-xl btn-primary mb-2" type="submit">Enregistrer</button>
                                                    <button class="btn bsb-btn-xl btn-secondary" type="button" data-bs-dismiss="modal" @click="$wire.resetfields()">Annuler</button>
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


