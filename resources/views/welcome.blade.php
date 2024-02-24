<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Modern Business - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body class="d-flex flex-column h-100">
        
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.html">B Mobile</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @if (Route::has('login'))
                                    @auth
                                        <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a></li>
                                        <li class="nav-item">
                                        <form method="POST" class="" action="{{ route('logout') }}">
                                            @csrf
                                            @method('POST')
                                            <button class="nav-link" type="submit">
                                                {{ __('Log Out') }}
                                            </button>
                                        </form>
                                        </li>
                             @else      
                                        <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                        </li>
                                    @endauth
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            @if(session('error'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                    <div class="alert alert-danger alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                        {{session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            @endif
            <!-- Header-->
            <header class="bg-dark py-5">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center justify-content-center">
                        <div class="col-lg-8 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">Riparime Profesionale të Telefonave</h1>
                                <p class="lead fw-normal text-white-50 mb-4">Partneri juaj i sigurtë për riparimin e telefonit tuaj!</p>
                                <div class="d-flex flex-column text-center text-xl-start">
                                    <p class="col lead fw-normal text-white mb-2">Shiko statusin e telefonit tuaj:</p>
                                    <form action="/" method="get" class="col">
                                        <div class="mb-3 d-flex">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="id"
                                                placeholder="ID e punës"
                                                autocomplete="off">
                                            <button type="submit" class="btn btn-outline-light">Kërko</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="{{ asset('storage/landing-page-photo/tosi.jpg') }}" alt="foto" /></div>
                    </div>
                </div>
            </header>
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    @if(request()->filled('id') && $job->count() < 1)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Scroll to the element with the ID 'your-element-id' when $jobs is set
                                document.getElementById('punt').scrollIntoView({ behavior: 'smooth' });
                            });
                        </script>

                        <h2 class="" id="punt">Nuk u gjet asnjë rezultat me ID-në e dhënë!</h2>
                    
                    @elseif($job == false)

                    @elseif($job->count() > 0)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Scroll to the element with the ID 'your-element-id' when $jobs is set
                                document.getElementById('punt').scrollIntoView({ behavior: 'smooth' });
                            });
                        </script>
                                <!-- kodi per me shfaq se sa koh ka kaluar prej kohes kur eshte pranuar puna -->
                            @php
                                $createdAt = \Carbon\Carbon::parse($job->created_at);
                                $timeElapsedCreated = $createdAt->diffForHumans();
                            @endphp
                            <!-- shfaqja e cardav per secilen pune te ndalur -->
                           
                            <div class="card" id="punt">
                                <div class="card-header">
                                    <p class="mb-0 text-secondary">ID: #{{ $job->id }}</p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title font-semibold text-xl">
                                        {{$job->client->name}}
                                        <span class="border rounded bg-{{$job->status->color}} text-light text-center d-inline p-1 text-sm">
                                        {{ $job->status->name }}</span>
                                    </h5>
                                    <p class="card-text text-sm text-secondary">{{$job->phone_model}}</p>
                                    <p class="card-text text-primary-emphasis">
                                        @if($job->status->id == 1)
                                            Puna është me statusin <span class="text-primary fw-bold">{{ $job->status->name }}</span> dhe nuk është procesuar akoma.
                                        @elseif($job->status->id == 2)
                                            Puna është me statusin <span class="text-primary fw-bold">{{ $job->status->name }}</span> dhe është duke u punuar akoma.
                                        @elseif($job->status->id == 3)
                                            Puna është me statusin <span class="text-primary fw-bold">{{ $job->status->name }}</span> dhe ju mundë të vini ta merrni paisjen e lënë.
                                        @elseif($job->status->id == 4)
                                            Puna është me statusin <span class="text-primary fw-bold">{{ $job->status->name }}</span> dhe ju e keni marrë nga dyçani jonë paisjen.
                                        @elseif($job->status->id == 5)
                                            Puna është me statusin <span class="text-primary fw-bold">{{ $job->status->name }}</span> dhe ju mundë të vini ta merrni paisjen e lënë.
                                        @endif
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">Përgjegjës: {{ $job->worker->name }} <a href="tel:{{ $job->worker->phone }}" class="btn btn-success btn-sm"><i class="bi bi-telephone-fill"></i></a></li>
                                </ul>
                                <div class="card-footer">
                                    <p class="text-secondary mb-0">{{ $timeElapsedCreated }}</p>
                                </div>
                            </div>
                            
                    </div>
                    @endif
                    
                    <div class="row gx-5 justify-content-center">
                            
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2><span class="text-primary-emphasis fw-bolder">{{ $jobs_count +  31000  }}</span> punë të kryera me sukses!</h2>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6 border rounded text-center">
                            <p class="lead fw-normal text-muted mb-5 d-inline">Ne numërojmë plot <span class="text-primary-emphasis fw-bolder">{{ $jobs_count + 31000}}</span> punë të kryera me sukses për klientët tanë, që nga 3 Marsi i 2020-tës. <br>
                            Përfito edhe ti prej shërbimeve tona të shpejta dhe sigurta!
                            </p>
                        </div>
                    </div>
                    
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; B Mobile 2024</div></div>
                    <div class="col-auto">
                        <span class="text-light">Sistemi eshte krijuar nga: </span>
                        <a class="link-light small" href="https://www.instagram.com/digital.solutions.l">Digital Solutions</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
</html>
