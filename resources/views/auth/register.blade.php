<x-app class="bg-gradient-primary">
    <x-slot name="styles">
        <link href="{{ asset("css/sb-admin-2.css") }}" rel="stylesheet">
    </x-slot>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="card o-hidden border-0 shadow-lg my-5 w-50">
                <div class="card-body p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form method="post" action="{{ route("login") }}" class="user">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user @error("name") is-invalid @enderror" value="{{ old("name") }}" required autocomplete="name" autofocus name="name" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error("email") is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" name="email" placeholder="Email Address">
                            @error("email")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user @error("password") is-invalid @enderror" name="password" required placeholder="Password">
                                @error("password")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user @error("password_confirmation") is-invalid @enderror" name="password_confirmation" required placeholder="Repeat Password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset("js/sb-admin-2.min.js") }}"></script>
    </x-slot>
</x-app>
