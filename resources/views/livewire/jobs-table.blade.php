<div class="table-responsive">
    <table class="table table-stripped table-bordered align-middle">
        <thead>
            <tr class="align-middle">
                <th>ID</th>
                <th>Klienti
                <!-- searchi klientit -->
                <form wire:keydown.debounce.250ms="search">
                    <input type="text" class="w-100 rounded" placeholder="Search" wire:model="clientQuery">
                </form>
                </th>
                <th>Status
                    <form>
                        <select name="puntort" wire:model.change="status" wire:change="search" id="puntort">
                            <option value="">Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </th>
                <th>Telefoni</th>
                <th>Përshkrimi</th>
                <!-- selecti puntorit -->
                <th>Puntori
                    <form>
                        <select name="puntort" wire:model.change="worker" wire:change="search" id="puntort">
                            <option value="">Puntort</option>
                            @foreach($workers as $worker)
                                <option value="{{ $worker->id }}">{{ explode(' ',$worker->name)[0] }}</option>
                            @endforeach
                        </select>
                    </form>
                </th>
                <!-- Date filter -->
                <th>Data
                    <form wire:submit="search" class="d-flex align-items-center w-40">
                        <input type="datetime-local" name="from" wire:model.change="from" wire:change="search" id="" class="d-inline w-40"></br>
                        <p class="mx-1">deri</p>
                        <input type="datetime-local" name="to" wire:model.change="to" wire:change="search" class="d-inline w-40" id="">
                    </form>
                </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <!-- kodi per me shfaq se sa koh ka kaluar prej kohes kur eshte pranuar puna -->
                @php
                    $createdAt = \Carbon\Carbon::parse($job->created_at);
                    $timeElapsedCreated = $createdAt->diffForHumans();
                @endphp
                <tr>
                    <td>{{$job->id}}</td>
                    <td>{{$job->client->name}}</td>
                    <td><p class="border rounded bg-{{$job->status->color}} text-light text-center d-inline p-1">{{$job->status->name}}</p></td>
                    <td>{{$job->phone_model}}</td>
                    @if(isset(str_split($job->description, 12)[1]))
                    <td>{{ str_split($job->description, 12)[0]."..." }}</td>
                    @else
                    <td>{{$job->description}}</td>
                    @endif
                    
                    <td>{{$job->worker->name}}</td>
                    <td>{{ $job->created_at }}, <p class="text-primary">{{$timeElapsedCreated}}</p></td>
                    <td class="d-flex">
                        <a class="btn btn-sm btn-success me-2" target="_blank" href="{{route('jobs.edit', ['job' => $job->id])}}"><i class="bi bi-pencil-square"></i></a>
                        <a class="btn btn-sm btn-primary me-2" target="_blank" href="{{route('job.print', ['job_id' => $job->id])}}"><i class="bi bi-printer-fill"></i></a>
                        @if(Auth::user()->hasRole('admin'))
                        <form method="POST" action="{{route('jobs.destroy', ['job' => $job->id])}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="confirm('A jeni i sigurte qe doni te fshini punen?')"><i class="bi bi-trash-fill"></i></button>
                        </form>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$jobs->links()}}
    
</div>
