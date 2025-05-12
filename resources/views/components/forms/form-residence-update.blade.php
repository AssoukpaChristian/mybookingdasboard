<div
    x-data = "{
        modal : null,
        init(){this.modal = new bootstrap.Modal($refs.modalUpdateResidence)},
        open(){this.modal.show()},
        close(){this.modal.hide()},
    }"
    x-init = "init()"
    @close-update-modal.window = "close()"
    class="modal fade"
    id="modalUpdateResidence"
    x-ref = "modalUpdateResidence"
    wire:ignore.self
    tabindex="-1"
    aria-labelledby="modalUpdateResidence"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une résidence</h1>
                <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$wire.resetfields()"></button>
            </div>

            <div class="modal-body">

                <!-- Registration 4 - Bootstrap Brain Component -->
                <section class="">
                    <div class="container-fluid">
                        <div class="card border-light-subtle shadow-sm">
                            <div class="row g-0">
                                <div class="col-12 col-md-6">
                                    <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/residence.jpg') }}" alt="residence Image">
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <h3 class="text-sm">Nouvelle résidence</h3>
                                                <h3 class="fs-6 fw-normal text-secondary m-0">Informations de la résidence</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <form wire:submit="update_residence()">

                                        <div class="row gy-3 gy-md-4 overflow-hidden">

                                            <div class="col-12">
                                                <label for="quartier" class="form-label">Quartier <span class="text-danger">*</span></label>
                                                <select id="quartier" name="quartier_id" class="form-select" wire:model.blur="quartier_id" required>
                                                    <option value="">Choisir un quartier</option>
                                                        @foreach ( \App\Models\Quartier::all() as $quartier)
                                                            <option value="{{ $quartier->id }}">{{ $quartier->commune->name }} | {{ $quartier->name }}</option>
                                                        @endforeach
                                                </select>
                                                @error('quartier_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                <input type="text" wire:model.blur="name" class="form-control" name="name" id="name" placeholder="Nom" required>
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="pieces" class="form-label">Nombre de pièces <span class="text-danger">*</span></label>
                                                <input type="number" wire:model.blur="pieces" class="form-control" name="pieces" id="pieces" placeholder="Nombre de pièces" required>
                                                @error('pieces') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="prix" class="form-label">Prix <span class="text-danger">*</span></label>
                                                <input type="number" min=50 wire:model.blur="prix" class="form-control" name="prix" id="prix" placeholder="Prix" required>
                                                @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                                                <input type="text" wire:model.blur="contact" class="form-control" name="contact" id="contact" placeholder="Contact">
                                                @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
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
</div>


