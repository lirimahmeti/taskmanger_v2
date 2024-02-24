<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Puntoret') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            @if(session('success'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>
            </div>
            @endif
            @if(session('updated'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" >
                    {{session('updated')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>
            </div>
            @endif
            @if(session('error'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" >
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>
            </div>
            @endif


            
           
           
            
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <livewire:worker-jobs-chart-today/> 
            
            <!-- Statistikat e puntorve vjetore -->
<div class="container px-0 mx-auto">
    @if($chart)
        <div class="p-3 mb-6 w-100 bg-white rounded shadow">
            {!! $chart->container() !!}
        </div>

        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
    @endif
</div>

<!-- Statistikat javore te puntorve -->


            @if($workers->count() > 0)
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emri</th>
                                <th>Numri</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workers as $worker)
                                <tr>
                                    <td>{{$worker->id}}</td>
                                    <td>{{$worker->name}}</td>
                                    <td>{{$worker->phone}}</td>
                                    <td class="d-flex">
                                        <form method="POST" action="{{ route('workers.destroy', ['worker' => $worker->id])}}" class="me-2" onsubmit="return window.confirm('Ju nese fshini puntorin fshini edhe te gjitha punet qe ka pranuar puntori. A jeni te sigurte?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                                        </form>
                                        <a href="{{route('workers.edit', ['worker' => $worker->id])}}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            
            @else
                <div class="d-flex row">  
                    <div class="border rounded shadow col-xxl-2 align-items-center justify-content-center d-flex text-center m-4 ms-4" style="height: 100px;">
                        {{$workers->count()}} <br>Puntorë
                    </div>
                </div>
                <table class="table table-bordered m-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Emri</th>
                            <th>Numri</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" align="center">Nuk ka puntor te regjistruar!</td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <a href="{{ route('workers.create') }}" class="btn btn-primary  me-auto">Shto <i class="bi bi-person-plus"></i></a>
            </div>
        </div>
    </div>
</x-app-layout>
