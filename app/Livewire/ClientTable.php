<?php

namespace App\Livewire;

use App\Models\Jobs;
use App\Models\Clients;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

final class ClientTable extends PowerGridComponent
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
        return Clients::query()
            ->select('clients.*', DB::raw('COUNT(jobs.client_id) AS job_count'))
            ->leftJoin('jobs', 'jobs.client_id', '=', 'clients.id')
            ->groupBy('clients.name', 'clients.id', 'clients.phone', 'clients.created_at', 'clients.updated_at');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('phone')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(''),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Numri punëve', 'job_count')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $client = Clients::findOrFail($rowId);
        $this->redirect(route('clients.edit', ['client' => $client->id]));
    }
    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId)
    {
        $client = Clients::findOrFail($rowId);
        $client_has_jobs = Jobs::where('client_id', $client->id)->get();

        if($client_has_jobs->count() > 0){
            return redirect()->route('clients.index')->with('message_error', 'Klienti nuk mundë të fshihet sepse ka punë të regjistruara.');
        } else{
            $client->delete();
            return redirect()->route('clients.index')->with('message_success', 'Klienti u fshi me sukses.');
        }
    }

    public function actions(\App\Models\Clients $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="bi bi-pencil-square"></i>')
                ->id()
                ->class('btn btn-sm btn-outline-primary')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('delete')
                ->slot('<i class="bi bi-trash-fill"></i>')
                ->id()
                ->class('btn btn-sm btn-danger')
                ->method('delete')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
