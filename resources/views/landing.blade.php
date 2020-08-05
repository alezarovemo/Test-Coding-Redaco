<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coding Test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/dark-mode.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sisi-kiri.css') }}">
</head>

<body class="bg-white text-center d-flex h-100">
  <div class="container-fluid d-flex p-1 mx-auto flex-column">
    <header class="mb-auto">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-2">
            <div class="container-fluid">
                <a class="nav-link" href="{{ route('landing') }}">
                <h5 class="text-dark mr-5 mt-1">Coding Test</h5>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
               
                <ul class="navbar-nav ml-auto">
                @guest
                            <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('all-program.beranda') }}">Home</a>
                            </li>
                            @if (Route::has('register'))
                            
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('all-program.beranda') }}">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-secondary" href="{{ route('detail-user.index') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('program.index') }}">Gallery</a>
                            </li>
                            @endguest
                </ul>
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                           
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                            
                            
                       
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-pink mr-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('detail-user.index') }}" role="button">
                                        profile <span class="caret"></span>
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="darkSwitch">
                        <label class="custom-control-label text-primary" for="darkSwitch"></label>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid shadow-sm rounded mt-2 p-5 shadow">
        <div class="row">
            <div class="col-5">
                <div class="text-left ml-5">
                    <h5>We Are</h5>
                    <h3 class="font-weight-bold mb-4">Redaco Hello Dribble</h3>
                    <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>

                    <a class="btn btn-pink mt-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>

            <div class="col-7">
                <img src="{{ asset('images/image - white.svg') }}" class="img-fluid" alt="...">
            </div>
        </div>
    </div>

    <div class="container-fluid p-3 mb-4 mt-4">
        <div class="row">
            <div class="col">
                <div class="button-group filters-button-group">
                <button class="btn btn-white" data-filter="*">Show All</button>
                <button class="btn btn-white" data-filter=".web">Web Design</button>
                <button class="btn btn-white" data-filter=".ilustration">Ilustration</button>
                <button class="btn btn-white" data-filter=".typo">Typhography</button>
                </div>
            </div>
        </div>
            
            <div class="row no-gutters d-flex mt-3 grid">
            @foreach($programs as $program)    
            <div class="col-4 mb-3 margin-auto  float-left element-item web" data-category="web">        
                <div class="shadow card-hover">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col float-left">
                                            <img class="bunder" src="{{ asset('storage/'. $program->photo) }}" class="img" alt="..." height="175" width="175" style="background-size: cover;">
                                        </div>
                                    
                                        <div class="col text-left float-left">
                                            <p class="pink font-weight-bold">{{$program->title}}</p>
                                                <div>
                                                <p class="text-justify"> {{ Str::limit($program->description, 70) }}</p>
                                                </div>
                                                <div>
                                                    <small class="font-weight-light"> {{$program->hastag}}  {{$program->subhastag}} </small>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>
               
                @endforeach  
                
                @foreach ($ilus as $ilu)
                <div class="col-4 floa margin-auto t-left element-item ilustration " data-category="ilustration">
                    <div class="shadow card-hover">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col float-left">
                                            <img class="bunder" src="{{ asset('storage/'. $ilu->photo) }}" class="img" alt="..." height="175" width="175" style="background-size: cover;">
                                            </div>
                                        
                                            <div class="col text-left float-left">
                                                <p class="pink font-weight-bold">{{$ilu->title}}</p>
                                                    <div>
                                                    <p class="text-justify"> {{ Str::limit($ilu->description, 70) }}</p>
                                                    </div>
                                                    <div>
                                                    <small class="font-weight-light"> {{$ilu->hastag}}  {{$ilu->subhastag}} </small>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                </div>
                @endforeach

                @foreach ($typos as $typo)
                <div class="col-4 floa margin-auto t-left element-item typo" data-category="typo">
                    <div class="shadow card-hover">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col float-left">
                                            <img class="bunder" src="{{ asset('storage/'. $typo->photo) }}" class="img" alt="..." height="175" width="175" style="background-size: cover;">
                                            </div>
                                        
                                            <div class="col text-left float-left">
                                                <p class="pink font-weight-bold">{{$typo->title}}</p>
                                                    <div>
                                                    <p class="text-justify"> {{ Str::limit($typo->description, 70) }}</p>
                                                    </div>
                                                    <div>
                                                    <small class="font-weight-light"> {{$typo->hastag}}  {{$ilu->subhastag}} </small>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                </div>
                @endforeach
                
                               
            </div>
        

    <div class="container-fluid mt-5 bg-light">
        <div class="row">
            <div class="col">
                <footer class="">
                     <p class="text mt-3"> Created &copy; 2020 by Saiful Bahri Irfanto</p>
                </footer>
            </div>
        </div>
    </div>
    

    <!-- You must load 'dark-mode-switch.js' at the foot of the page -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dark-mode-switch.min.js') }}"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="{{ asset('js/iso.js') }}"></script>
  </div>
</body>

</html>