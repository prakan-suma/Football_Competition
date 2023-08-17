<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AFT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <form class="col-4" action="{{ url('/auth') }}" method="post">
                @csrf

                {{-- error  --}}
                @if ($errors->any())
                    <div class="alert alert-warning">
                        {{ $errors->first() }}
                    </div>
                @endif

                <h3>Login</h3>
                <p>ASEAN Football Tournament</p>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

            </form>
        </div>
    </main>
</body>

</html>
