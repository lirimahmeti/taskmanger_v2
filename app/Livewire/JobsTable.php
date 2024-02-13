<?php

namespace App\Livewire;

use App\Models\Jobs;
use App\Models\Status;
use DateTimeImmutable;
use App\Models\Workers;
use Livewire\Component;
use Livewire\WithPagination;

class JobsTable extends Component
{
    use WithPagination;
    
    public $clientQuery = '';
    public $worker = '';
    public $jobsQuery;
    public $status = '';
    public $from = '';
    public $to = '';

    

    public function search(){
        $this->resetPage();
    }

 
    public function render()
    {   
        $jobsQuery = Jobs::with('client', 'worker', 'status', 'message');

        if($this->clientQuery != ''){
            $jobs = $jobsQuery->whereRelation('client', 'name', 'like', '%'.$this->clientQuery.'%')->latest()->paginate(10);
        }
        else if($this->worker != ''){
            $jobs = $jobsQuery->where('worker_id', $this->worker)->latest()->paginate(10);
        }
        else if($this->status != ''){
            $jobs = $jobsQuery->where('status_id', $this->status)->latest()->paginate(10);
        }
        else if($this->from != '' and $this->to != ''){
            $fromFormated = new DateTimeImmutable($this->from);
            $fromFormated->format('YYYY-MM-DD hh:mm:ss');

            $toFormated = new DateTimeImmutable($this->to);
            $toFormated->format('YYYY-MM-DD hh:mm:ss');

    
            $jobs = $jobsQuery->whereBetween('created_at', [$fromFormated, $toFormated])->latest()->paginate(10);
        }
        else{
            $jobs = $jobsQuery->latest()->paginate(10);
        }

        return view('livewire.jobs-table', [
        'workers' => Workers::all(),
        'jobs' => $jobs,
        'statuses' => Status::all(),
    ]);
    }
}
// ->orWhere('worker_id', $this->worker)