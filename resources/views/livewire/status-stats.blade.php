<div class="row">
   
    @foreach($data as $d)
        <div class="col m-3 rounded d-flex flex-column align-items-center justify-content-center  bg-{{ $d['color'] }}" style="height: 90px;">
            <p class="text-light m-0 p-0">{{$d['statusi']}}</p> 
            <h3 class="text-light">{{ $d['status_count'] }}</h3>
        </div>
    @endforeach
</div>
