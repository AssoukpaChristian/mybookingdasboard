<div>
    <x-slot name="breadcrumb">
        <div class="row mb-3">
            <h3 class="mb-0 text-secondary">Accueil from livewire</h3>
        </div>
    </x-slot>

    <div class="row mx-0 px-0">
        <div class="col-6 col-md-3">
          <a href="{{ route('bookings') }}" class="text-decoration-none">
            <!-- small box -->
            <div class="small-box text-bg-success d-ico">
              <div class="inner">
                <h3 class="fs-1">Bookings</h3>
                <p>Bookings</p>
              </div>
              <img src="{{ asset('img/booking.png') }}" alt="booking" class="ico_dash_ct"/>
            </div>
          </a>
        </div>

        <div class="col-6 col-md-3">
          <a href="{{ route('clients') }}" class="text-decoration-none">
            <!-- small box -->
            <div class="small-box text-bg-danger d-ico">
              <div class="inner align-items-center">
                <h3 class="fs-1">Clients</h3>
                <p>Clients</p>
              </div>
              <img src="{{ asset('img/client.png') }}" alt="client" class="ico_dash_ct"/>
            </div>
        </a>
        </div>

        <div class="col-6 col-md-3">
          <a href="{{ route('operations') }}" class="text-decoration-none">
            <!-- small box -->
            <div class="small-box text-bg-warning d-ico">
              <div class="inner align-items-center">
                <h3 class="fs-1">Comptabilité</h3>
                <p>Comptabilité</p>
              </div>
              <img src="{{ asset('img/comptabilite.png') }}" alt="Comptabilité" class="ico_dash_ct"/>
            </div>
        </a>
        </div>

        <div class="col-6 col-md-3">
          <a href="{{ route('residences') }}" class="text-decoration-none">
            <!-- small box -->
            <div class="small-box text-bg-primary d-ico">
              <div class="inner d-flex ">
                <h3 class="fs-1">Résidences</h3>
                <p>Résidences</p>
              </div>
              <img src="{{ asset('img/residence.png') }}" alt="Résidences" class="ico_dash_ct"/>
            </div>
        </a>
        </div>

        <div class="col-6 col-md-3">
          <a href="{{ route("statistiques") }}" class="text-decoration-none">
            <!-- small box -->
            <div class="small-box text-bg-secondary d-ico">
              <div class="inner">
                <h3 class="fs-1">Statistiques</h3>
                <p>Statistiques</p>
              </div>
              <img src="{{ asset('img/statistiques.png') }}" alt="statistiques" class="ico_dash_ct"/>
            </div>
          </a>
        </div>

        <div class="col-6 col-md-3">
          <a href="{{ route('users') }}" class="text-decoration-none">
            <!-- small box -->
            <div class="small-box  text-white d-ico" style="background-color: #7330F9 !important;">
              <div class="inner">
                <h3 class="fs-1">Utilisateurs</h3>
                <p>Utilisateurs</p>
              </div>
              <img src="{{ asset('img/utilisateur.png') }}" alt="utilisateurs" class="ico_dash_ct"/>
            </div>
          </a>
        </div>
    </div>
</div>
