<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Klientet') }}
        </h2>
        @if(session('message_error'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-danger alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    {{session('message_error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
        @endif
        @if(session('message_success'))
            <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    {{session('message_success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
        @endif
        @if(session('client_edited'))
        <div class="position-fixed top-0 start-50 translate-middle-x">
                <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    {{session('client_edited')}}
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
                <livewire:client-table/>
            <a href="{{ route('clients.create') }}" class="btn btn-primary  me-auto">Shto <i class="bi bi-person-plus"></i></a>
            </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
