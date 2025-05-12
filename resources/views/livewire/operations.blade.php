<div>
    <x-slot name="breadcrumb">
        <div class="row mb-3">
            <h3 class="mb-0 text-secondary">Opérations</h3>
        </div>
    </x-slot>

    <!-- Modal Ajout-->
    <x-forms.form-operation-add />

    <!-- Modal Modification-->
    <x-forms.form-operation-update />

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-sm-4">
                <h5 class="">Période</h5>
                <form class="mx-0 w-50 d-flex">
                    <select wire:model.live = "search_annee" name="search_annee">
                        @foreach($annees as $annee)
                            <option value="{{ $annee }}">{{ $annee }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live = "search_mois" name="search_mois">
                        @foreach($mois as $numero => $nom)
                            <option value="{{ $numero }}">{{ $nom }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="col-sm-4  p-0 align-items-start">
                <h5 class="me-1">Caisse</h5>
                <input type="number" name="caisse" id="caisse" wire:model.live="caisse" style="width:130px" class="bg-white fw-bold" disabled />
            </div>

            <!-- Button trigger modalAddOperation -->
            <div class="col-sm-4 text-end align-item-start">
                <button
                    @click = "$wire.resetfields()"
                    type="button"
                    class="btn btn-sm btn-success mt-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAddOperation">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-plus-circle-fill"
                        viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"></path>
                    </svg>
                        Nouvelle opération
                  </button>
            </div>
        </div>
        <div class="card-body p-1 table-responsive">
                <!--MESSAGE d'ERREUR-->
                    <x-session-message />
                <!--MESSAGE d'ERREUR-->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Montant</th>
                        <th>Mode de paiement</th>
                        <th>Type</th>
                        <th>Résidence</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($operations)
                        @forelse ($operations as $operation)
                            <tr>
                                <td>{{ ucwords($operation->transaction->name) }}</td>
                                <td>{{ ucwords($operation->montant) }}</td>
                                <td>{{ ucwords($operation->mode_paiement) }}</td>
                                <td><span class="badge text-bg-{{ $operation->transaction->type === 'Dépense' ? 'danger' : 'success' }}">{{ ucwords($operation->transaction->type) }}</span></td>
                                <td>{{ ucwords($operation->residence_id) ? ucwords($operation->residence->name) : "" }}</td>
                                <td>{{ Carbon\Carbon::parse($operation->operationdate)->format('d-m-Y') }}</td>
                                <td class="d-flex justify-content-center">
                                    {{-- <button
                                        type="button"
                                        wire:click="edit_operation({{ $operation->id }})"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalUpdateOperation"
                                        class="btn btn-sm btn-outline-warning me-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-pencil-square"
                                            viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"></path>
                                        </svg>
                                    </button> --}}

                                    <form wire:confirm="Veuillez confirmer la suppression ! \n {{ $operation->name }}" wire:submit="delete_operation({{ $operation->id }})">
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                class="bi bi-trash-fill"
                                                viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"></path>
                                                </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucune opération enrégistrée</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="7" class="text-center">Les opérations ne sont pas disponibles.</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">{{ $operations->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <x-remove-alert-message />

</div>

