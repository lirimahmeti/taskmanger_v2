<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            {{ __('Punët') }}
            <a href="{{ route('jobs.create') }}" class="btn btn-sm btn-outline-primary mb-4" >Shto punë <i class="bi bi-plus-square"></i></a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <livewire:jobs-table/>
            <a href="{{ route('workers.create') }}" class="btn btn-primary  me-auto">Shto <i class="bi bi-person-plus"></i></a>
            </div>
            </div>
        </div>
</div>
   
</x-app-layout><i class="bi bi-arrow-down-up"></i>
