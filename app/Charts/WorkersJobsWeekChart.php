<?php

namespace App\Charts;

use App\Models\Jobs;
use App\Models\Workers;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class WorkersJobsWeekChart
{
    protected $chartWeek;

    public function __construct(LarapexChart $chartWeek)
    {
        $this->chartWeek = $chartWeek;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $workers = Workers::all();
        
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
       
        $workerJobCount = [];
        foreach($workers as $worker){
            $jobCounts = [];
            foreach ($days as $day) {
                $jobCounts[] = Jobs::where('worker_id', '=', $worker->id)
                    ->where('status_id', '=', 4)
                    ->whereDay('updated_at', '=', date('N', strtotime($day)))
                    ->count();
            }
            $workerJobCount[] = [$worker->name, $jobCounts];
        }

        $chartWeek = $this->chartWeek->barChart()
            ->setTitle('Statistikat e puntorve - Javore')
            ->setSubtitle('Nr.Punëve të përfunduara');

        foreach($workerJobCount as $data){
            $chartWeek->addData($data[0], $data[1]);
        }

        $chartWeek->setXAxis($days);

        return $chartWeek;
    }
}