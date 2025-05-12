<!doctype html>
<html lang="fr">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>MyBookingDashBoard | Dashboard</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="MyBookingDashBoard | Dashboard" />
    <meta name="author" content="assoukpachristian@gmail.com" />
    <meta name="description"content="My dashboard for handling my booking"/>
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    /><!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

    <style>
      .plus-button {
        width: 2.5rem; /* ou la taille que vous voulez */
        height: 2.5rem; /* ou la taille que vous voulez */
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ced4da; /* Ajoute une bordure légère */
      }

      .plus-button:hover {
        background-color: #f8f9fa; /* Légère modification au survol */
      }

      .ico_side_bar{
        width: 40px;
        height: 40px;
        margin-top: -5px;
      }
      .ico_side_bar_2{
        width: 30px;
        height: 30px;
        margin-top: -5px;
      }

      .bg_ico_sb:hover,.bg_ico_sb:active{
        background-color: #FFC107;
      }
      .bg_ico_sb:hover a{
        color:black !important;
        font-weight: bold;
      }

      .small-box{
        padding-bottom: 10px;
      }
      .small-box .inner{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      .inner h3{
        font-size: 1.7em !important;
      }
      .d-ico{
        display:flex;
        flex-wrap: wrap;
        flex-direction: column;
        align-items: center;
      }
      .ico_dash_ct{
        width:20%;
        height: 20%;
      }

      .errorlist{
        color: red;
        font-weight: bold;
      }

      th{
        vertical-align: top;
      }
    </style>

  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--  **************  MENU DU HAUT   **************  -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">

                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>

                    <li class="nav-item d-none d-md-block">
                        <a href="{{ route('home') }}" class="nav-link">
                            Home
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                @auth
                    <!--USER MENU-->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img
                                    src="{{ asset('img/user2-160x160.jpg') }}"
                                    class="user-image rounded-circle shadow"
                                    alt="User Image"
                                />
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <!--begin::User Image-->
                                <li class="user-header text-bg-primary">
                                    <img
                                    src="{{ asset('img/user2-160x160.jpg') }}"
                                    class="rounded-circle shadow"
                                    alt="User Image"
                                    />
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>{{ Auth::user()->email }}</small>
                                    </p>
                                </li>
                                <!--end::User Image-->

                                <!--begin::Menu Footer-->
                                <li class="user-footer d-flex justify-content-center">
                                    {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <input type="submit" value="Log Out" class="btn btn-danger btn-flat" />
                                    </form>
                                </li>
                                <!--end::Menu Footer-->
                            </ul>
                        </li>
                    </ul>
                    <!--end::USER MENU-->
                @endauth

            </div>
        </nav>
        <!--  **************  MENU DU HAUT   **************  -->

        <!--  **************  MENU DE GAUCHE  **************  -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--LOGO -->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{ route('home') }}" class="brand-link">
                    <!--begin::Brand Image-->
                    <img
                    src="{{ asset('img/AdminLTELogo.png') }}"
                    alt="My Booking Dasboard Logo"
                    class="brand-image opacity-75 shadow"
                    />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">Dashboard</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end LOGO-->

            <livewire:nav />
        </aside>
        <!--  **************  end::MENU DE GAUCHE  **************  -->

        <!--  **************  MAIN CONTENT  *****************-->
        <main class="app-main">

            <!--begin::App Content Header-->
            <div class="app-content-header px-0 px-md-2">
                <!--Fil D'ARIANNE-->
                <div class="container-fluid">
                    <div class="row">
                    {{ $breadcrumb }}
                    </div>
                </div>
                <!--Fil D'ARIANNE-->

                <!--MESSAGE d'ERREUR-->
                @foreach (['success', 'danger', 'warning', 'info'] as $msg)
                    @if(session()->has($msg))
                        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                            {{ session()->get($msg) }} from layout
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif
                @endforeach
            </div>
            <!--end::App Content Header-->


            <!--begin::App Content-->
            <div class="app-content px-0 px-md-2">
            <!--begin::Container-->
            <div class="container-fluid px-0 px-md-2">
                <div class="row">
                <div class="col-12">
                    {{ $slot }}
                </div>
                </div>
            </div>
            <!--end::Container-->
            </div>
            <!--end::App Content-->

        </main>
      <!--end::MAIN CONTENT-->

      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; {{ date('Y') }}&nbsp;
          <a href="{% url 'dashboard:index' %}" class="text-decoration-none">My Booking Dashboard</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer><!--end::Footer-->

    </div>
    <!--end::App Wrapper-->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/adminlte.js') }}"></script>

    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>

    <script>

      document.addEventListener('DOMContentLoaded', function() {

        flatpickr.localize(flatpickr.l10ns.fr);
        flatpickr('[x-ref="dateInput"]');


        //Ajouter la classe datePicker à <input type="date" class="datePicker"/>
        document.querySelectorAll('input.datePicker').forEach((input) => {
            input.addEventListener('focus', () => {
                if (typeof input.showPicker === 'function') {
                    input.showPicker();
                }
            });
        });



    })
    </script>

  </body>
</html>
