<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            {{ __('Dashboard') }}
            <a href="{{ route('jobs.create') }}" class="btn btn-sm btn-outline-primary mb-4" >Shto punë <i class="bi bi-plus-square"></i></a>
        </h2>
        @if(session('new_job'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-danger alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    {{session('new_job')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
        @endif
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-4 mx-4" data-bs-delay="2000" role="alert">
                 {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                </div>
            @endif
             <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                @foreach($workers as $worker)
                    <livewire:worker-jobs workerName="{{ $worker->name}} " workerID="{{ $worker->id }}" workerPhone="{{ $worker->phone }}"/>      
                @endforeach  
                </div>
            <div class="mt-4">
            <livewire:jobs-table/>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
