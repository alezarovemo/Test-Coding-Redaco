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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body class="bg-white text-center d-flex">
  <div class="container-fluid d-flex p-3 mx-auto flex-column">
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

    <div class="container-fluid shadow p-3 rounded mt-3 ">
        <div class="row p-3">
            <div class="col d-flex justify-content-center">
                <div class="card rounded w-75">
                    <div class="card-header text-left">
                        Create New Post
                    </div>
                    <div class="card-body text-left p-4">
                        <form method="POST" action="{{ route('program.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">                          
                                <input type="hidden" class="form-control" value="{{ Auth::user()->id }}" name="user_id">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title Program">
                            </div>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control" id="" name="category_id">
                                @foreach ($cats as $cat)
                                <option value="{{ $cat->id}}">{{ $cat->category}}</option>
                                @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo Program</label>
                                <input type="file" class="form-control" name="photo" placeholder="Enter email">
                            </div>
                            @error('photo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="description" rows="5"></textarea>
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hastag</label>
                                <input type="text" class="form-control" name="hastag" placeholder="Hastag">
                            </div>
                            @error('hastag')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">SubHastag</label>
                                <input type="text" class="form-control" name="subhastag" placeholder="Subhastag">
                            </div>
                            @error('subhastag')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-pink">Submit</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3 bg-light">
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
  </div>
</body>

</html>