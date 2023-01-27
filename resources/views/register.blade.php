<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<body class="text-center">

    <main class="form-signin">
        <form method="POST" action="/register">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Register</h1>

            <div class="form-floating">
                <input type="name" class="form-control" id="name" placeholder="Name" name="name" required>
                <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email"
                    required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    placeholder="Password" name="password" required>
                <label for="floatingPassword">Password</label>
                @error('password')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-floating" style="margin-bottom: 10px">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" placeholder="Password" name="password_confirmation" required>
                <label for="floatingPassword">Confirm Password</label>
                @error('password_confirmation')
                    {{ $message }}
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            <p class="mt-2 mb-3 text-muted">Already registered? <a href="/login">Log in?</a></p>
        </form>
    </main>
</body>

</html>
