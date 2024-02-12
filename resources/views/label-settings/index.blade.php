<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Parametrat e letres') }}
        </h2>
       
    </x-slot>

    @if(session('chosen_set'))
        <div class="position-fixed top-0 start-50 translate-middle-x">
            <div class="alert alert-success alert-dismissible fade show mt-3 overflow-hidden shadow-xl sm:rounded-lg"  role="alert">
                {!! session('chosen_set') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                <!-- Tabela per shfaqejen e parametrave te ruajtur per printim -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>Emërtimi</th>
                        <th>Dimenzionet</th>
                        <th>Edito</th>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                        <tr>
                            <td> {{ $setting->name }}</td>
                            <td>{{ round($setting->paper_width) }}mm X {{ round($setting->paper_height) }}mm</td>
                            <td class="d-flex justify-content-between g-2">

                                <!-- nese e kemi parametrin ne fjale te zgjedhur te shfaqet butoni grayed out -->
                                @if($setting->chosen == 1)
                                    <button class="btn btn-sm btn-success" disabled><i class="bi bi-check-lg"></i></button>
                                @else
                                <!-- nese parametri ne fjale nuk eshte i zgjedhur per printim te shfaqet forma e cila mundeson zgjedhjen e tij -->
                                    <form method="POST" action="{{ route('label-settings.update', ['label_setting' => $setting->id, 'chosen' => 1])}}">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i></button>
                                    </form>
                                @endif

                                <div class="d-flex">
                                    <!-- Butoni qe te qon tek faqja per editimin e parametrit egzistues -->
                                    <a href="{{ route('label-settings.edit', ['label_setting' => $setting->id]) }}" target="_blank"
                                        class="btn btn-sm btn-primary me-2">
                                        <i class="bi bi-sliders"></i>
                                    </a>

                                    <!-- Butoni per fshirjen e parametrit ne fjale -->
                                    <form method="POST" action="{{ route('label-settings.destroy', ['label_setting' => $setting->id])}}" onsubmit="return window.confirm('A jeni i sigurtë që doni të fshini parametrin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            <!-- Butoni qe te dergon tek faqja per shtimin e parametrav te ri per printim -->
            <a href="{{ route('label-settings.create') }}" class="btn btn-primary  me-auto">Shto <i class="bi bi-plus"></i></a>
            </div>
            </div>
        </div>
    </div>
   
</x-app-layout>
