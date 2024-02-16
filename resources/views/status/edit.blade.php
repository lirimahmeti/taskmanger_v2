<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edito statuset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="alert alert-info m-4">
                    <i class="bi bi-info-circle"></i>
                    Nese klikoni "<b><a href="#checkbox" class="link-offset-2">Percakto si entitet aktiv</a></b>"  punet me kete status do te shfaqen dhe numrohen ne dashboard tek seksioni ku shfaqen punet aktive te puntorit.
                </div>
                <div class="alert alert-info m-4">
                    <i class="bi bi-info-circle"></i>
                    Ngjyrat: 
                    <span class="bg-primary m-1 p-1 rounded text-light">primary</span>
                    <span class="bg-secondary m-1 p-1 rounded text-light">secondary</span>
                    <span class="bg-success m-1 p-1 rounded text-light">success</span>
                    <span class="bg-danger m-1 p-1 rounded text-light">danger</span>
                    <span class="bg-warning m-1 p-1 rounded text-light">warning</span>
                    <span class="bg-info m-1 p-1 rounded text-light">info</span>
                    <span class="bg-dark m-1 p-1 rounded text-light">dark</span>
                    <span class="bg-black p-1 rounded text-light">black</span>
                </div>
                    
                <form method="POST" action="{{ route('status.update', ['status' => $status->id]) }}" class="p-4">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Emri statusit</label>
                        <input type="text" class="form-control" name="status_name" value="{{$status->name}}" id="exampleFormControlInput1" placeholder="statusi">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput" class="form-label">Ngjyra e statusit</label>
                        <input type="text" class="form-control" name="status_color" value="{{$status->color}}" id="exampleFormControlInput" placeholder="ngjyra">
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="active" value="1" id="checkbox">
                        <label for="checkbox" class="form-label">Percakto si entitet aktiv</label>
                    </div>
                    <button class="btn btn-outline-primary">Ruaj ndryshimin <i class="bi bi-floppy"></i></button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
