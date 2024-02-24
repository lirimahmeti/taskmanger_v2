<?php

namespace App\Charts;

use App\Models\Jobs;
use App\Models\Workers;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WorkersJobsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {   
        $workers = Workers::all();
        
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthsSQ = ['Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor','Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nentore', 'Dhjetore'];

        $workerJobCount = [];
        foreach($workers as $worker){
            $jobCounts = [];
            foreach ($months as $month) {
                $jobCounts[] = Jobs::where('worker_id', '=', $worker->id)
                    ->where('status_id', '=', 4)
                    ->whereMonth('updated_at', '=', date('m', strtotime($month)))
                    ->count();
            }
            $workerJobCount[] = [$worker->name, $jobCounts];
        }

     
        $chart = $this->chart->barChart()
        ->setTitle('Statistikat e puntorve - Vjetore')
        ->setSubtitle('Nr.Punëve të përfunduara');

        foreach($workerJobCount as $data){
                $chart->addData($data[0], $data[1]);
            }

        $chart->setXAxis($monthsSQ);


        return $chart;
    }
}
