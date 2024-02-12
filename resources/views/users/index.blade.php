<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Përdoruesit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    @if($users->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emri</th>
                                <th>Email</th>
                                <th>Rolet</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach(Spatie\Permission\Models\Role::pluck('name')->all() as $role)
                                        @if(in_array($role, $user->roles->pluck('name')->all()))
                                            <span class="btn btn-sm btn-outline-secondary disabled ms-2"> {{ $role }}</span>
                                        @else
                                            <!-- Do something else if the role is not present for the user -->
                                            <form method="POST" class="d-inline ms-2" action="{{ route('users.update', ['user' => $user->id, 'role' => $role]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-primary">{{ $role }}</button>
                                                <!-- Other form elements -->
                                            </form>
                                        @endif
                                    @endforeach
                                </td>
                                <td align="center">
                                    <form method="POST" action="{{ route('users.destroy', ['user' => $user->id])}}" onsubmit="return window.confirm('A jeni i sigurtë që doni të fshini userin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        0 users
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</x-app-layout>
