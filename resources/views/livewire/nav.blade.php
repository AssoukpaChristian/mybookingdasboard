<!--Liste des liens options-->
<div class="sidebar-wrapper">
    <ul class="nav sidebar-menu flex-column"
    data-lte-toggle="treeview"
    role="menu"
    data-accordion="false">
        <!-- Client -->
        <li class="nav-item rounded pt-1 bg_ico_sb">
            <a href="{{ route('clients') }}" class="nav-link" >
                <img src="{{ asset('img/client.png') }}" alt="client" class="ico_side_bar"/>
                <p class="text-uppercase">
                    Client
                </p>
            </a>
        </li>

        <!-- Comptabilité -->
        <li class="nav-item rounded pt-1 ">
            <a href="#" class="nav-link">
                <img src="{{ asset('img/comptabilite.png') }}" alt="comptabilite" class="ico_side_bar"/>
                <p class="text-uppercase">
                Comptabilité
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ps-3">
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('operations') }}" class="nav-link" >
                        <img src="{{ asset('img/operation.png') }}" alt="pays" class="ico_side_bar_2"/>
                        <p class="text-title">
                            Opérations
                        </p>
                    </a>
                </li>
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('transactions') }}" class="nav-link" >
                        <img src="{{ asset('img/transaction.png') }}" alt="pays" class="ico_side_bar_2"/>
                        <p class="text-title">
                            Libellés des opérations
                        </p>
                    </a>
                </li>
            </ul>
        </li>


        <!-- Booking -->
        <li class="nav-item rounded pt-1 ">
            <a href="#" class="nav-link">
                <img src="{{ asset('img/booking.png') }}" alt="comptabilite" class="ico_side_bar"/>
                <p class="text-uppercase">
                Booking
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ps-3">
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('bookings') }}" class="nav-link" >
                        <img src="{{ asset('img/reservation.png') }}" alt="Booking" class="ico_side_bar"/>
                        <p class="text-uppercase">
                            Booking
                        </p>
                    </a>
                </li>
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('calendar') }}" class="nav-link" >
                        <img src="{{ asset('img/calendrier.png') }}" alt="pays" class="ico_side_bar_2"/>
                        <p class="text-title">
                            Calendrier
                        </p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Résidences -->
        <li class="nav-item rounded pt-1 bg_ico_sb">
            <a href="{{ route('residences') }}" class="nav-link" >
                <img src="{{ asset('img/residence.png') }}" alt="Résidence" class="ico_side_bar"/>
                <p class="text-uppercase">
                    Résidences
                </p>
            </a>
        </li>

        <!-- Localisations -->
        <li class="nav-item rounded pt-1 ">
            <a href="#" class="nav-link">
                <img src="{{ asset('img/localisation.png') }}" alt="Résidence" class="ico_side_bar"/>
                <p class="text-uppercase">
                Localisations
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ps-3">
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('pays') }}" class="nav-link" >
                        <img src="{{ asset('img/pays.png') }}" alt="pays" class="ico_side_bar_2"/>
                        <p class="text-title">
                            Pays
                        </p>
                    </a>
                </li>
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('communes') }}" class="nav-link" >
                        <img src="{{ asset('img/commune.png') }}" alt="pays" class="ico_side_bar_2"/>
                        <p class="text-title">
                            Communes
                        </p>
                    </a>
                </li>
                <li class="nav-item bg_ico_sb">
                    <a href="{{ route('quartiers') }}" class="nav-link" >
                        <img src="{{ asset('img/quartier.png') }}" alt="pays" class="ico_side_bar_2"/>
                        <p class="text-title">
                            Quartiers
                        </p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Statistiques -->
        <li class="nav-item rounded pt-1 bg_ico_sb">
            <a href="{{ route('statistiques') }}" class="nav-link" >
                <img src="{{ asset('img/statistiques.png') }}" alt="Statistiques" class="ico_side_bar"/>
                <p class="text-uppercase">
                    Statistiques
                </p>
            </a>
        </li>

        <!-- Utilisateurs -->
        <li class="nav-item rounded pt-1 bg_ico_sb">
            <a href="{{ route('users') }}" class="nav-link" >
                <img src="{{ asset('img/utilisateur.png') }}" alt="utilisateurs" class="ico_side_bar"/>
                <p class="text-uppercase">
                    Utilisateurs
                </p>
            </a>
        </li>

    </ul>

</div>
<!--end::Sidebar Wrapper-->
