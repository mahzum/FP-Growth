<!doctype html>
<html lang="en">

<head>
    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{url('/')}}/system/public/css/bootstrap.min.css">

    <title>FP Growth Application</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="#">FP Growth</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('log')}}">Log</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> --}}
            </ul>
        </div>
    </nav>

    <main role="main">
        <div class="jumbotron">
          @yield('content')
        </div>
    </main>
    {{-- Optional JavaScript --}}
    {{-- jQuery first, then Popper.js, then Bootstrap JS --}}
    <script src="{{url('/')}}/system/public/js/jquery-3.3.1.slim.min.js"></script>
    <script src="{{url('/')}}/system/public/js/popper.min.js"></script>
    <script src="{{url('/')}}/system/public/js/bootstrap.min.js"></script>
</body>

</html>s
