<div>
    <x-slot name="breadcrumb">
        <div class="row mb-3">
            <h3 class="mb-0 text-secondary">Calendrier de Bookings</h3>
        </div>
    </x-slot>


    <div id='calendar' class="m-auto"></div>
    <!-- Modal -->


    <x-remove-alert-message />

    @script
    <script>

        document.addEventListener('livewire:navigated', function () {
            const calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            // Détruire l'instance précédente si elle existe
            if (calendarEl._fullCalendar) {
                calendarEl._fullCalendar.destroy();
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($calendarbookings),
                locale: 'fr',
                timeZone: 'UTC',
                eventClick: function(info) {
                    alert(info.event.title);
                }
            });

            calendar.render();
            // Stocker l'instance pour une éventuelle destruction future
            calendarEl._fullCalendar = calendar;
        });

    </script>
    @endscript

</div>

