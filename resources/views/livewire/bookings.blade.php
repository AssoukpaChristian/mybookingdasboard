<div>
    <x-slot name="breadcrumb">
        <div class="row mb-3">
            <h3 class="mb-0 text-secondary">Bookings</h3>
        </div>
    </x-slot>

    <!-- Modal Ajout-->
    <x-forms.form-booking-add />

    <!-- Modal Modification-->
    <x-forms.form-booking-update />

    <!-- Modal Paiement-->
    <x-forms.form-booking-payer />

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

            <!-- Button trigger modalAddBooking -->
            <div class="col-sm-4 text-end align-item-start">
                <button
                    @click = "$wire.resetfields()"
                    type="button"
                    class="btn btn-sm btn-success mt-3"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAddBooking">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-plus-circle-fill"
                        viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"></path>
                    </svg>
                        Nouveau booking
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
                        <th>Client</th>
                        <th>Residence</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Mode de paiement</th>
                        <th>Montant de la location</th>
                        <th>Montant à payer</th>
                        <th>Montant payé</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bookings)
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ ucwords($booking->client->name) }}</td>
                                <td>{{ ucwords($booking->residence->name) }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->start)->format('d-m-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->end)->format('d-m-Y') }}</td>
                                <td>{{ ucwords($booking->mode_paiement) }}</td>
                                <td>{{ number_format($booking->montant, 0, '', '.') }}</td>
                                <td>{{ number_format($booking->montant_total, 0, '', '.') }}</td>
                                <td>{{ number_format($booking->montant_total - $booking->reliquat, 0, '', '.') }}</td>
                                <td><span class="badge text-bg-{{ $booking->status === 'soldé' ? 'success' : 'warning' }}">{{ ucwords($booking->status) }}</span></td>
                                <td class="d-flex justify-content-center">
                                    {{-- <button
                                        type="button"
                                        wire:click="edit_booking({{ $booking->id }})"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalUpdateBooking"
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

                                    @if ($booking->reliquat>0)
                                        <button
                                            type="button"
                                            wire:click="edit_booking({{ $booking->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPayerBooking"
                                            class="btn btn-sm btn-outline-success me-2">
                                            Paiement
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <form wire:confirm="Veuillez confirmer la suppression ! \n Booking - résidence: {{ $booking->residence->name }} | {{ $booking->date_debut }} {{ $booking->date_fin }}Client: {{ $booking->client->name }}" wire:submit="delete_booking({{ $booking->id }})">
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                            Supprimer
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
                                <td colspan="10" class="text-center">Aucun booking enrégistré</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="10" class="text-center">Les bookings ne sont pas disponibles.</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">{{ $bookings->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <x-remove-alert-message />

    @script
    <script>

        document.addEventListener('livewire:initialized', function() {

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($calendarbookings),
            locale: 'fr',
            timeZone: 'UTC',
            allDay: true,
            eventClick: function(info) {
                alert('Réservation ID: ' + info.event.id);
            }
        });
        calendar.render();

      });

    </script>
    @endscript

</div>

