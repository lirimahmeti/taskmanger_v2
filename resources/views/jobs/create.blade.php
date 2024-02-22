<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if(session('success'))
                <div class="position-fixed top-0 start-50 translate-middle-x">
                    <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <!-- Kodi per me shfaq print pagen per kur ta shtojm punen ne databaz me sukses -->
            @if(session('new_job'))
                <div class="position-fixed top-0 start-50 translate-middle-x">
                    <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                        Puna u shtua me sukses në databazë.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                        <a href="{{ route('job.print', ['job_id' => session('new_job')]) }}" id="printLink" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary"><i class="bi bi-printer"></i></a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var printLink = document.getElementById('printLink');
                        printLink.click();
                    });
                </script>
            @endif
            
            @if(session('error'))
                <div class="position-fixed top-0 start-50 translate-middle-x">
                    <div class="alert alert-danger alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                        {{session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if(session('userExists'))
                <div class="position-fixed top-0 start-50 translate-middle-x">
                    <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                    <b>{{session('userExists')}}</b> është selektuar për regjistrimin e punës.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            
                <livewire:job-create-form/>
                    <!-- forma per ruajtjen e punes ne databaze -->
                <form method="POST" action="{{ route('jobs.store', ['client_id' => session('client')?->id]) }}" class="p-4">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Klienti zgjedhur</label>
                        @if(session('client'))
                            <input type="text" class="form-control is-valid rounded" disabled value="{{session('client')?->name ? session('client')?->name:'Asnjë'}}" id="klienti">
                        @else
                            <input type="text" class="form-control is-invalid rounded" disabled value="{{session('client')?->name ? session('client')?->name:'Asnjë'}}" id="klienti">
                        @endif
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="exampleFormControlInput2" class="form-label">Modeli telefonit <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control rounded" autocomplete="off" name="phone_model" id="exampleFormControlInput2" placeholder="iphone...">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput2" class="form-label">IMEI</label>
                            <input type="text" class="form-control rounded" autocomplete="off" name="imei" id="exampleFormControlInput2" placeholder="359451590651017">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput2" class="form-label">Kodi</label>
                            <input type="text" class="form-control rounded" autocomplete="off" name="kodi" id="exampleFormControlInput2" placeholder="123456">
                        </div>
                    </div>
                    <label for="worker_id">Puntori:<span class="text-danger">*</span></label>
                    <select class="form-select" name="worker_id" aria-label="Default select example">
                        @foreach($workers as $worker)
                            <option value=" {{ $worker->id }} ">{{$worker->name}}</p>
                        @endforeach
                    </select>
                    <div class="mb-3 mt-3">
                        <label for="exampleFormControlInput2" class="form-label">Përshkrimi: <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="description" rows="3" required placeholder="Shkruaj detaje rreth punes."></textarea>
                    </div>
                    <button class="btn btn-outline-primary" type="submit">punen <i class="bi bi-person-plus-fill"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modali per printim -->
    <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                ...
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
