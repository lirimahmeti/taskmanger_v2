<?php

namespace App\Livewire;

use App\Models\Jobs;
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

    public function mount($workerName = null, $workerID = null, $workerPhone = null)
    {   
        $this->workerPhone = $workerPhone;
        $this->workerName = $workerName;
        $this->workerID = $workerID;
        $this->statusNewID = 1;
        $this->statusProcesID = 2;
        

        $this->Jobs = Jobs::where('worker_id', $this->workerID)->whereIn('status_id', array($this->statusNewID, $this->statusProcesID))->count();
    }

    public function render()
    {
        return view('livewire.worker-jobs');
    }
}
