<?php

namespace App\Livewire;

use App\Models\Transfer;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Support\Facades\DB;


final class UserTransfer extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(), 
            
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Transfer::query()
            ->join('accounts as source_account', 'transfers.root_account_id', '=', 'source_account.id')
            ->join('accounts as destination_account', 'transfers.destination_account_id', '=', 'destination_account.id')
            ->select('transfers.*', 'source_account.name as source_account_name', 
                'destination_account.name as destination_account_name',
                'source_account.transactions_count as source_transactions_count',);
    }

    public function relationSearch(): array
    {
        return [
            'rootAccount' => ['name']
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('source_account_name')
            ->addColumn('quantity')
            ->addColumn('destination_account_name')
            ->addColumn('source_transactions_count')
            ->addColumn('created_at_formatted', fn (Transfer $model) 
                => Carbon::parse($model->created_at)
                ->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Total trans.', 'source_transactions_count' )
                    ->searchable()
                    ->sortable(),
            Column::make('Cuenta Origen', 'source_account_name' )
                    ->searchable()
                    ->sortable(),
            Column::make('Quantity', 'quantity')
                    ->sortable()
                    ->searchable(),
            Column::make('cuenta Destino', 'destination_account_name')
                    ->searchable()
                    ->sortable(),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    { 
        return [
            Filter::number('quantity', 'Quantity'),
            //crete flatpicker filter
            Filter::datePicker('created_at','transfers.created_at')
        ];
    }


    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\Transfer $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    public function showSearchInput(): bool
    {
        return true;
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
