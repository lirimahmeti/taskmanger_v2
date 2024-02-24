<?php

namespace App\Livewire;

use App\Models\Workers;
use Livewire\Component;
use Illuminate\Support\Carbon;

class WorkerJobsChartToday extends Component
{
    public $workers;
    public $job_count;
    public $start_date;
    public $end_date;
    public $jsonData;

    public function render()
    {
        $dataArr = [['Puntort', 'Punet']];

        $this->workers = Workers::withCount(['jobs' => function ($query) {
            $query->whereDate('updated_at', Carbon::today())->where('status_id', '=', '4');
            }])->get();
        
        foreach($this->workers as $worker){
            $dataArr[] = [$worker->name, $worker->jobs_count];
        }
        
        $jsonData = json_encode($dataArr); // Ensure numeric values are not treated as strings

        $this->jsonData = $jsonData;
        
        return view('livewire.worker-jobs-chart-today', ['data' => $this->jsonData]);
    }
}