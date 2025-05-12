<div>
    <x-slot name="breadcrumb">
        <div class="row mb-3">
            <h3 class="mb-0 text-secondary">Clients</h3>
        </div>
    </x-slot>

    <!-- Modal Ajout-->
    <x-forms.form-client-add />

    <!-- Modal Modification-->
    <x-forms.form-client-update />

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-sm-6">
                <h5 class="">Liste des clients</h5>
            </div>
            <!-- Button trigger modalAddClientr -->
            <div class="col-sm-6 text-end">
                <button
                    @click = "$wire.resetfields()"
                    type="button"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAddClient">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-plus-circle-fill"
                        viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"></path>
                    </svg>
                        Ajouter un client
                  </button>
            </div>
        </div>
        <div class="card-body">
                <!--MESSAGE d'ERREUR-->
                    <x-session-message />
                <!--MESSAGE d'ERREUR-->

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Pays</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->contact }}</td>
                            <td>{{ ucwords($client->pays->name) }}</td>
                            <td class="d-flex justify-content-center">
                                <button
                                    type="button"
                                    wire:click="edit_client({{ $client->id }})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalUpdateClient"
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
                                </button>

                                <form wire:confirm="Veuillez confirmer la suppression ! \n {{ $client->name }}" wire:submit="delete_client({{ $client->id }})" x-ref="formdeleteclient">
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
                            <td colspan="5" class="text-center">Aucun client enrégistré</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">{{ $clients->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <x-remove-alert-message />

</div>

