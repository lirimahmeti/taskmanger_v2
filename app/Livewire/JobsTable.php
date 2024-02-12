<?php

namespace App\Livewire;

use App\Models\Jobs;
use App\Models\Status;
use App\Models\Clients;
use App\Models\Workers;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class JobsTable extends PowerGridComponent
{
    use WithExport;

    public string $sortField = 'id';
    
    public string $sortDirection = 'desc';

    public function setUp(): array
    {
    
        return [
            
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Jobs::query()->select('jobs.*',
        'clients.name as klienti', 
        'clients.phone as kontakti',
        'status.name as status',
        'workers.name as puntori',)
        ->join(table: 'clients', first: 'jobs.client_id', operator: '=', second: 'clients.id')
        ->join(table: 'status', first: 'jobs.status_id', operator: '=', second: 'status.id')
        ->join(table: 'workers', first: 'jobs.worker_id', operator: '=', second: 'workers.id');
    }

    public function relationSearch(): array
    {
        return [
            'worker' => ['name'],
            'client' => ['name']
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('klienti')
            ->add('kodi')
            ->add('client_id')
            ->add('puntori')
            ->add('worker_id')
            ->add('status')
            ->add('status_id')
            ->add('description')
            ->add('phone_model')
            ->add('imei')
            ->add('created_at_formatted', function(Jobs $model){
                return Carbon::parse($model->created_at)->format( format: 'd/m/y H:i');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Klienti', 'klienti')
                ->sortable()
                ->searchable(),
            Column::make('Puntori', 'puntori')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::make('Phone model', 'phone_model')
                ->sortable()
                ->searchable(),
            Column::make('IMEI', 'imei')
                ->sortable()
                ->searchable(),
            Column::make('Kodi', 'kodi'),
            Column::make('Pranuar', 'created_at_formatted')
                ->sortable()
                ->searchable()
                ,
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('created_at_formatted', 'created_at'),
            Filter::Select('status', 'status_id')
            ->dataSource(Status::all())
            ->optionValue('id')
            ->optionLabel('name'),
            Filter::Select('puntori', 'worker_id')
            ->dataSource(Workers::all())
            ->optionValue('id')
            ->optionLabel('name'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->redirect(route('jobs.edit', ['job' => $rowId]));
    }
    #[\Livewire\Attributes\On('print')]
    public function print($rowId): void
    {
        $this->redirect(route('job.print', ['job_id' => $rowId]));
    }

    public function actions(\App\Models\Jobs $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('btn btn-outline-primary btn-sm')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('print')
                ->slot('Print')
                ->id()
                ->class('btn btn-outline-success btn-sm')
                ->dispatch('print', ['rowId' => $row->id])
                ->target('_blank')
        ];
    }

    
    // public function actionRules($row): array
    // {
    //    return [
    //         // Hide button edit for ID 1
    //         Rule::field('status')
    //             ->when(fn($row) => $row->status == 'new')
    //             ->class('badge bg-danger'),
    //     ];
    // }
    
}
