<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="Roles.libraries.styles.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="auth">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light p-5">
                        <div class="text-center mb-4">
                            <img src="assets/images/logo/logo-main.png" alt="logo" class="mb-4">
                            <h4>Hello! Let's get started</h4>
                            <p class="text-muted">Sign in to continue.</p>
                        </div>
                        <!-- Login Form -->
                        <form action="{{ route('login') }}" method="GET">
                            @csrf
                            <!-- CSRF token for security -->
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control form-control-lg"
                                    id="exampleInputUsername1" placeholder="Username" value="{{ old('username') }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 py-2">SIGN IN</button>
                            </div>
                            <div class="text-center mt-4">
                                <span class="text-muted">Don't have an account?</span>
                                <a href="{{ route('role.register') }}" class="text-primary">Create</a>
                            </div>
                        </form>
                        <!-- End of Login Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>