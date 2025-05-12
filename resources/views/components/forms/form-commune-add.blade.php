<div
    x-data = "{
        modal : null,
        init(){this.modal = new bootstrap.Modal($refs.modalAddCommune)},
        open(){this.modal.show()},
        close(){this.modal.hide()},
    }"
    x-init = "init()"
    @close-add-modal.window = "close()"
    class="modal fade"
    id="modalAddCommune"
    x-ref = "modalAddCommune"
    wire:ignore.self
    tabindex="-1"
    aria-labelledby="modalAddCommune"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une commune</h1>
                <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$wire.resetfields()"></button>
            </div>

            <div class="modal-body">

                <!-- Registration 4 - Bootstrap Brain Component -->
                <section class="">
                    <div class="container-fluid">
                        <div class="card border-light-subtle shadow-sm">
                            <div class="row g-0">
                                <div class="col-12 col-md-6">
                                    <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/localisation.jpg') }}" alt="localisation Image">
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <h3 class="text-sm">Nouvelle commune</h3>
                                                <h3 class="fs-6 fw-normal text-secondary m-0">Informations de la commune</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <form wire:submit="add_commune()" action="" x-ref="formaddcommune">

                                        <div class="row gy-3 gy-md-4 overflow-hidden">
                                            <div class="col-12">
                                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                                <input type="text" wire:model.blur="name" class="form-control" name="name" id="name" placeholder="Nom" required>
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="pays" class="form-label">Pays <span class="text-danger">*</span></label>
                                                <select id="pays" name="pays_id" class="form-select" wire:model.blur="pays_id" required>
                                                    <option value="">Choisir un pays</option>
                                                    @foreach ( \App\Models\Pays::all() as $pay)
                                                        <option value="{{ $pay->id }}">{{ $pay->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pays_id') <span class="text-danger">{{ $message }}</span> @enderror
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


