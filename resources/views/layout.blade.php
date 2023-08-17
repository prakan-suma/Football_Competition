<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASEAN Football Tournament</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
    <header>
        <nav class="navbar bg-dark navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ASEAN Football Tournament</a>
                <div class="d-flex">
                    <a class="nav-link text-white" href="{{ url('/logout') }}">Logout</a>
                </div>
            </div>
            </div>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>

</html>
