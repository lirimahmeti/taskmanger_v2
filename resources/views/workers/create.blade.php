<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shto puntor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('workers.store') }}" class="p-4">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Emri</label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="filan fisteku">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Numri tel.</label>
                        <input type="text" class="form-control" name="phone" id="exampleFormControlInput2" placeholder="044123123">
                    </div>
                    <button class="btn btn-outline-primary">Shto puntorin <i class="bi bi-person-plus-fill"></i></button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
