<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edito statuset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                    <button class="btn btn-outline-primary">Ruaj ndryshimin <i class="bi bi-floppy"></i></button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
