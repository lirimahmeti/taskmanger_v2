<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Punët') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            
            <!-- kodi per me shfaq se sa koh ka kaluar prej kohes kur eshte bere update per here te fundit puna ne fjal -->
            @php
                $updatedAt = \Carbon\Carbon::parse($job->updated_at);
                $timeElapsed = $updatedAt->diffForHumans();
            @endphp

             <!-- kodi per me shfaq se sa koh ka kaluar prej kohes kur eshte pranuar puna -->
             @php
                $createdAt = \Carbon\Carbon::parse($job->created_at);
                $timeElapsedCreated = $createdAt->diffForHumans();
            @endphp
            
                <!-- cardi per me shfaq te dhenat e klientit ne fjale -->
                <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
                    <div class="col">
                        <div class="card mb-3">
                            <!-- Headeri i cardit te jobit -->
                            <div class="card-header d-flex justify-content-between">
                                <p class="card-text"><small class="text-body-secondary">Pranuar: {{ $job->created_at }}</small></p>
                                <p class="card-text"><small class="text-body-secondary">{{ $timeElapsedCreated }}</small></p>
                            </div>
                            <!-- Body i cardit -->
                            <div class="card-body">
                                <h5 class="card-title text-lg font-semibold">{{ $job->client->name }}</h5>
                                <p class="card-text">{{ $job->description }}</p>
                            </div>
                            <!-- Informacionet rreth punes -->
                            <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-primary d-flex align-items-center justify-content-between">Kontakti: {{ $job->client->phone }}<a href="tel:{{ $job->client->phone }}" class="btn btn-sm btn-success"><i class="bi bi-telephone-inbound"></i></a> </li>
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item"><i class="bi bi-phone">:</i> {{ $job->phone_model }}</li>
                                        <!-- Logjika per shfaqjen / editimin e imeit -->
                                        @if($job->imei)
                                            <li class="list-group-item"><span class="badge bg-secondary">IMEI:</span> {{ $job->imei }} 
                                            <!-- Button trigger modal per edit-->
                                            <button type="button" class="btn btn-sm text-success" data-bs-toggle="modal" data-bs-target="#kodiModal">
                                                    <i class="bi bi-plus-square"></i>
                                            </button>
                                        </li>
                                        @else
                                            <li class="list-group-item">
                                            <span class="badge bg-secondary">IMEI:</span> <span class="text-secondary text-sm">{{ $job->imei?$job->imei:'NULL' }}</span>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm text-success" data-bs-toggle="modal" data-bs-target="#imeiModal">
                                                    <i class="bi bi-plus-square"></i>
                                                </button>
                                            </li>
                                        @endif
                                        <!-- Logjika per shfaqjen / editimin e kodit te telefonit -->
                                        @if($job->kodi)
                                            <li class="list-group-item">
                                                <span class="badge bg-secondary">Kodi <i class="bi bi-unlock"></i></span>{{ $job->kodi }} 
                                                <!-- Button trigger modal per edit-->
                                                <button type="button" class="btn btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#kodiModal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </li>
                                        @else
                                            <li class="list-group-item">
                                                <span class="badge bg-secondary">Kodi <i class="bi bi-unlock"></i></span> <span class="text-secondary text-sm">{{ $job->kodi?$job->kodi:'NULL' }}</span>
                                                <!-- Button trigger modal per edit -->
                                                <button type="button" class="btn btn-sm text-success" data-bs-toggle="modal" data-bs-target="#kodiModal">
                                                    <i class="bi bi-plus-square"></i>
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                    <li class="list-group-item">Status: <span class="badge bg-{{ $job->status->color }}">{{ $job->status->name }}</span></li>
                            </ul>
                            <!-- Footeri i cardit te punes -->
                            <div class="card-footer d-flex justify-content-between">
                                <p class="card-text"><small class="text-body-secondary">Last update: {{ $timeElapsed }}</small></p>
                                <p class="card-text"><small class="text-body-secondary">Pranoi: {{ $job->worker->name }}</small></p>
                            </div>
                        </div>
                    </div>

                <!-- forma per me shtu mesazh -->
                <div class="col">
                    <div class="d-flex">
                        
                        @foreach($statuses as $status)
                            @if($status->name != 'new' and $status->id != $job->status->id)
                                <form class="me-2 mb-2" action="{{ route('jobs.update', ['job' => $job->id, 'status' => $status->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $status->color }}">{{$status->name}}</button>
                                </form>
                            @endif
                        @endforeach
                    </div>
                    <form method="POST" action="{{ route('message.store', ['job_id' => $job->id]) }}" class="border p-3 rounded">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Shto mesazh</label> <br>
                            <select name="worker_id" class="form-select mb-3" id="">
                                @foreach($workers as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                @endforeach
                            </select>
                            <textarea class="form-control" name="mesazhi" id="mesazhi" rows="3" placeholder="Shkruaj detaje rreth punes."></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Shto <i class="bi bi-send"></i></button>
                    </form>
                </div>



                <!-- Poshte jan modalet qe shfaqen per shtimin e imeit edhe kodit te telefonit ne databaz -->

                <!-- Modali per me shtu imei-->
                <div class="modal fade" id="imeiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Shto IMEI numrin</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('jobs.update', ['job' => $job->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label class="" for="imei">IMEI:</label>
                                        <input class="form-control rounded" type="text" name="imei" id="imei" placeholder="Thirr *#06# për IMEI numrin">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                </form>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modali per me shtu kodin e telefonit-->
                <div class="modal fade" id="kodiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Shto kodin e telefonit</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('jobs.update', ['job' => $job->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="kodi">Kodi:</label>
                                        <input class="form-control rounded" type="text" name="kodi" id="kodi" placeholder="1234">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                </form>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- seksioni ku shfaq komentet e bera nga perdoruesit per punen perkatese -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-5">
                <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Mesazhet <i class="bi bi-chat-left-text-fill"></i></h2>
                <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
                    @foreach($job->message->reverse() as $message)
                        @php
                            $updatedAt = \Carbon\Carbon::parse($message->updated_at);
                            $timeElapsed = $updatedAt->diffForHumans();

                            $worker = $workers->firstWhere('id', $message->worker_id);
                        @endphp
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-md font-semibold">{{ $worker->name }} <i class="bi bi-person-circle"></i></h5>
                                    <p class="card-text">{{$message->mesazhi}}</p>
                                    
                                    <p class="card-text"><small class="text-body-secondary">Komentuar: {{ $timeElapsed }}</small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
