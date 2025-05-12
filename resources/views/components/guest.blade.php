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

      .bg_ico_sb:hover{
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

    </style>

  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

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
          Copyright &copy; 2025&nbsp;
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

  </body>
</html>
