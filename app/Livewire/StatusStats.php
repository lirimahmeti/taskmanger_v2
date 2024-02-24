<?php

namespace App\Livewire;

use App\Models\Jobs;
use App\Models\Status;
use Livewire\Component;
use Illuminate\Support\Carbon;

class StatusStats extends Component
{
    public $data = [];

    public function mount()
    {
        $statuses = Status::all();

        foreach($statuses as $status){
            $this->data[] = ['statusi' => $status->name, 'color' => $status->color , 'status_count' => Jobs::where('status_id', '=',$status->id)
            ->whereDate('updated_at', Carbon::today())
            ->count()];
        }

    }


    public function render()
    {
        return view('livewire.status-stats');
    }
}
