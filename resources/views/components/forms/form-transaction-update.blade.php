<div
    x-data = "{
        modal : null,
        init(){this.modal = new bootstrap.Modal($refs.modalUpdateTransaction)},
        open(){this.modal.show()},
        close(){this.modal.hide()},
    }"
    x-init = "init()"
    @close-update-modal.window = "close()"
    class="modal fade"
    id="modalUpdateTransaction"
    x-ref = "modalUpdateTransaction"
    wire:ignore.self
    tabindex="-1"
    aria-labelledby="modalUpdateTransaction"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier un libellé d'opération</h1>
                <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$wire.resetfields()"></button>
            </div>

            <div class="modal-body">

                <!-- Registration 4 - Bootstrap Brain Component -->
                <section class="">
                    <div class="container-fluid">
                        <div class="card border-light-subtle shadow-sm">
                            <div class="row g-0">
                                <div class="col-12 col-md-6">
                                    <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/comptabilité.jpg') }}" alt="comptabilité Image">
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <h3 class="text-sm">Modifier le libellé</h3>
                                                <h3 class="fs-6 fw-normal text-secondary m-0">Informations libellé opération</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <form wire:submit="update_transaction()">

                                        <div class="row gy-3 gy-md-4 overflow-hidden">

                                            <div x-data="{name:''}" class="col-12">
                                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                <input x-model="name" @input="name = name.toLowerCase()"  type="text" wire:model.blur="name" class="form-control" name="name" id="name" placeholder="Nom" required>
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                                <select name="type" id="type" wire:model.blur="type" class="form-select" required>
                                                    <option value="">Choisir le type</option>
                                                    <option value="Dépense">Dépense</option>
                                                    <option value="Recette">Recette</option>
                                                </select>
                                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
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


