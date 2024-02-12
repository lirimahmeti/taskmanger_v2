<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edito statuset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            @if(session('success'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
            @endif
            @if(session('updated'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-success alert-dismissible fade show mt-3" style="width: 80vw;" role="alert" >
                    {{session('updated')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
            @endif
         
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            
            @if($statuses->count() > 0)
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emri</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{$status->id}}</td>
                                    <td>{{$status->name}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('status.edit', ['status' => $status->id])}}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            
            @else
                <div class="d-flex row">  
                    <div class="border rounded shadow col-xxl-2 align-items-center justify-content-center d-flex text-center m-4 ms-4" style="height: 100px;">
                        {{$statuses->count()}} <br>Puntorë
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
            <a href="{{ route('status.create') }}" class="btn btn-primary  me-auto">Shto <i class="bi bi-person-plus"></i></a>
            </div>
        </div>
    </div>
   
</x-app-layout>
