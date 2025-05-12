<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Calendar extends Component
{
    public $calendarbookings;

    public function mount(){
        $this->loadBookings();
    }

    public function loadBookings()
    {
        $this->calendarbookings = \App\Models\Booking::all()->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->residence->name.' | Client: '.$booking->client->name,
                'start' => $booking->start,
                // 'end' => $booking->end,
                'end' => Carbon::parse($booking->end)->addDay()->toDateString(),


            ];
        });
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $this->loadBookings();
        return view('livewire.calendar');
    }
}
