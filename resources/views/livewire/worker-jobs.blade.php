<div class="col">
    <style>
        .worker-cards:hover{
            opacity: 0.8;
            background-color: rgba(0, 167, 255, 0.3);
        }
    </style>
    <div class="card worker-cards">
        <a href="{{route('worker.jobs',['worker' => $workerID, 'status' => 'active'])}}" class="link-dark link-offset-2 link-underline link-underline-opacity-0">
        <div class="card-header text-lg">
            {{ $workerName }}
        </div>
        <div class="card-body">
            Punë aktive <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-1.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $jobs_count }}</span>
        </div>
        <div class="card-footer">
            <span><i class="bi bi-telephone"></i> {{ $workerPhone ? $workerPhone : 'Nuk ka numer' }}</span>
        </div>
        </a>
    </div>
</div>
