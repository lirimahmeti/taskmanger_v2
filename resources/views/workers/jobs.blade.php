<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Puntët e {{$worker->name}}'t
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 

            <!-- Pjesa per shfaqjen e puneve me status te ri -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-3 mb-2 text-center">
                    Punët e reja
                </h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
            @if($jobs_new->count() > 0)
                @foreach($jobs_new as $job)
                     <!-- kodi per me shfaq se sa koh ka kaluar prej kohes kur eshte pranuar puna -->
                    @php
                        $createdAt = \Carbon\Carbon::parse($job->created_at);
                        $timeElapsedCreated = $createdAt->diffForHumans();
                    @endphp

                    <!-- shfaqja e cardav per secilen pune te ndalur -->
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title font-semibold text-xl">
                                    {{$job->client->name}}
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ $job->status->name }}</span>
                                </h5>
                                <p class="card-text text-sm text-secondary">{{$job->phone_model}}</p>
                                <p class="card-text">{{$job->description}}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <p class="text-danger">{{ $timeElapsedCreated }}</p>
                                <a href="{{ route('jobs.edit', ['job' => $job->id]) }}" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">Puno</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- nese nuk kemi pune -->
                <p class="text-center">Nuk ka asnjë punë të re</p>

            @endif
                </div>
            </div>

            <!-- Pjesa per shfaqjen e puneve me status ne proces -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mt-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-3 mb-2 text-center">
                    Punët në proces
                </h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
            @if($jobs_ne_proces->count() > 0)
                
                @foreach($jobs_ne_proces as $job)
                     <!-- kodi per me shfaq se sa koh ka kaluar prej kohes kur eshte pranuar puna -->
                    @php
                        $createdAt = \Carbon\Carbon::parse($job->created_at);
                        $timeElapsedCreated = $createdAt->diffForHumans();
                    @endphp

                    <!-- shfaqja e cardav per secilen pune te ndalur -->
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title font-semibold text-xl">{{$job->client->name}} <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ $job->status->name }}</span></h5>
                                <p class="card-text text-sm text-secondary">{{$job->phone_model}}</p>
                                <p class="card-text">{{$job->description}}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <p class="text-danger">{{ $timeElapsedCreated }}</p>
                                <a href="{{ route('jobs.edit', ['job' => $job->id]) }}" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">Puno</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- nese nuk kemi pune -->
                <p class="text-center">Nuk ka asnjë punë në proces</p>

            @endif
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
