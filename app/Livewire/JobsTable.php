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
        
        //searchi klientit
        if($this->clientQuery != ''){
            $jobs = $jobsQuery->whereRelation('client', 'name', 'like', '%'.$this->clientQuery.'%');
        }
        //filtrimi me puntor
        else if($this->worker != ''){
            $jobs = $jobsQuery->where('worker_id', $this->worker);
            //filtrimi me puntor dhe status
            if($this->status != ''){
                $jobs = $jobsQuery->where('status_id', $this->status);
                //filtrimi me puntor, status dhe dat
                if($this->from != '' and $this->to != ''){
                    $fromFormated = new DateTimeImmutable($this->from);
                    $fromFormated->format('YYYY-MM-DD hh:mm:ss');
        
                    $toFormated = new DateTimeImmutable($this->to);
                    $toFormated->format('YYYY-MM-DD hh:mm:ss');
        
            
                    $jobs = $jobsQuery->whereBetween('created_at', [$fromFormated, $toFormated]);
                }
            }
            //filtrimi me dat
            if($this->from != '' and $this->to != ''){
                $fromFormated = new DateTimeImmutable($this->from);
                $fromFormated->format('YYYY-MM-DD hh:mm:ss');
    
                $toFormated = new DateTimeImmutable($this->to);
                $toFormated->format('YYYY-MM-DD hh:mm:ss');
    
        
                $jobs = $jobsQuery->whereBetween('created_at', [$fromFormated, $toFormated]);
            }
        }
        //filtrimi me status
        else if($this->status != ''){
            $jobs = $jobsQuery->where('status_id', $this->status);
            //filtrimi me status dhe dat
            if($this->from != '' and $this->to != ''){
                $fromFormated = new DateTimeImmutable($this->from);
                $fromFormated->format('YYYY-MM-DD hh:mm:ss');
    
                $toFormated = new DateTimeImmutable($this->to);
                $toFormated->format('YYYY-MM-DD hh:mm:ss');
    
        
                $jobs = $jobsQuery->whereBetween('created_at', [$fromFormated, $toFormated]);
            }
        }
        //filtrimi vetem me date
        else if($this->from != '' and $this->to != ''){
            $fromFormated = new DateTimeImmutable($this->from);
            $fromFormated->format('YYYY-MM-DD hh:mm:ss');

            $toFormated = new DateTimeImmutable($this->to);
            $toFormated->format('YYYY-MM-DD hh:mm:ss');

    
            $jobs = $jobsQuery->whereBetween('created_at', [$fromFormated, $toFormated]);
        }
        //pa filtra
        else{
            $jobs = $jobsQuery;
        }

        return view('livewire.jobs-table', [
        'workers' => Workers::all(),
        'jobs' => $jobs->latest()->paginate(10),
        'statuses' => Status::all(),
    ]);
    }
}
// ->orWhere('worker_id', $this->worker)