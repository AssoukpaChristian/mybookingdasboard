<x-guest>
    <x-slot name="breadcrumb">
        <div class="row mb-3">
            <h3 class="mb-0 text-secondary"></h3>
        </div>
    </x-slot>

    <!-- Registration 8 - Bootstrap Brain Component -->
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xxl-11">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="{{ asset('img/logo-img-1.webp') }}" alt="Welcome back you've been missed!">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                        <div class="col-12 col-lg-11 col-xl-10">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                        <div class="text-center mb-4" class="brand-link">
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
                                        </div>
                                        <h2 class="h4 text-center">Connexion</h2>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row gy-3 overflow-hidden">

                                        <!-- Email Address -->
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    name="email"
                                                    id="email"
                                                    value="{{ old('email') }}"
                                                    placeholder="name@example.com"
                                                    autofocus autocomplete="email"
                                                    required>
                                                <label for="email" class="form-label">Email</label>
                                            </div>
                                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="password"
                                                    id="password"
                                                    value=""
                                                    placeholder="Password"
                                                    autofocus autocomplete="password"
                                                    required>
                                                <label for="password" class="form-label">Mot de passe</label>
                                            </div>
                                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="col-12">
                                            <div class=" form-check mb-3">
                                                <label for="remember_me" class="form-check-label">Rester connecter</label>
                                                <input
                                                type="checkbox"
                                                class="form-check-input"
                                                name="remember_me"
                                                id="remember_me"
                                                value=""
                                                autofocus>
                                            </div>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-dark btn-lg" type="submit">Se connecter</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-guest>


