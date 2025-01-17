<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="auth">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light p-5">
                        <div class="text-center mb-4">
                            <img src="assets/images/logo/logo-main.png" alt="logo" class="mb-4">
                            <h4>New here?</h4>
                            <p class="text-muted">Signing up is easy. It only takes a few steps</p>
                        </div>

                        <!-- Display success message -->
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Display validation errors -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <!-- CSRF Token for security -->
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control form-control-lg"
                                    id="exampleInputUsername1" placeholder="Username" value="{{ old('username') }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control form-control-lg"
                                    id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 py-2">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4">
                                <span class="text-muted">Already have an account?</span>
                                <a href="{{ route('role.login') }}" class="text-primary">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>