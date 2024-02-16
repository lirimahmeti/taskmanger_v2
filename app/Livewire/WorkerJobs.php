<?php

namespace App\Livewire;

use App\Models\Jobs;
use App\Models\Status;
use App\Models\Workers;
use Livewire\Component;

class WorkerJobs extends Component
{
    public $workerName;
    public $workerID;
    public $Jobs;
    public $statusNewID;
    public $statusProcesID;
    public $workerPhone;
    public $activeStatuses;
    public $activeStatusesArr;

    public function mount($workerName = null, $workerID = null, $workerPhone = null)
    {   
        $this->workerPhone = $workerPhone;
        $this->workerName = $workerName;
        $this->workerID = $workerID;
       
    }

    public function render()
    { 
        $this->activeStatusesArr = array();
        $this->activeStatuses = Status::where('active',1)->get();

        foreach($this->activeStatuses as $activeStatus){
            array_push($this->activeStatusesArr, $activeStatus->id);
        }

        $this->Jobs = Jobs::where('worker_id', $this->workerID)->whereIn('status_id', $this->activeStatusesArr)->count();
        return view('livewire.worker-jobs', ['jobs_count' => $this->Jobs]);
    }
}
