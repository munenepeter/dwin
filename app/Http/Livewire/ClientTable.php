<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Insurance;
use App\Models\Underwriter;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ClientTable extends PowerGridComponent {
    use ActionButton;
    use WithExport;

    //Custom per page
    public int $perPage = 6;

    //Custom per page values
    public array $perPageValues = [0, 5, 10, 20, 50];


    public function setUp(): array {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount('short'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Client>
     */
    public function datasource(): Builder {
        return Client::query()->with('underwriter')
            ->with('insurance');
        // return Client::query()->join('underwriters', 'clients.underwriter_id', '=', 'underwriters.id')
        //  ->select('clients.*', 'underwriters.name as underwiter');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent {
        return PowerGrid::eloquent()
            // ->addColumn('id')
            ->addColumn('full_names')
            ->addColumn('policy_number')
            ->addColumn('risk_id', fn (Client $model) => strtoupper(e($model->risk_id)))
            ->addColumn('insurance.name', fn (Client $model) => ucwords($model->insurance->name))
            ->addColumn('underwriter.name', fn (Client $model) => (strlen($model->underwriter->name) <= 3) ? strtoupper($model->underwriter->name) : ucwords($model->underwriter->name))
            ->addColumn('sum_insured', fn (Client $model) => 'Ksh ' . number_format(e($model->sum_insured)))
            ->addColumn('political_risk', fn (Client $model) => 'Ksh ' . number_format(e($model->political_risk)))
            ->addColumn('excess_protector', fn (Client $model) => 'Ksh ' . number_format(e($model->excess_protector)))
            ->addColumn('basic_premium', fn (Client $model) => 'Ksh ' . number_format(e($model->basic_premium)))
            ->addColumn('annual_total_premium', fn (Client $model) => 'Ksh ' . number_format(e($model->annual_total_premium)))
            ->addColumn('annual_expiry_date_formatted', fn (Client $model) => Carbon::parse($model->annual_expiry_date)->format('d/m/Y'))
            ->addColumn('annual_renewal_date_formatted', fn (Client $model) => Carbon::parse($model->annual_renewal_date)->format('d/m/Y'))
            ->addColumn('updated_at_formatted', fn (Client $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array {
        return [
            //Column::make('Id', 'id'),
            Column::make('Full names', 'full_names')
                ->sortable()
                ->searchable(),

            Column::make('Policy No', 'policy_number')
                ->sortable()
                ->searchable(),

            Column::make('Risk id', 'risk_id')
                ->sortable()
                ->searchable(),

            Column::make('Insurance', 'insurance.name')
                ->sortable()
                ->searchable(),

            Column::make('Underwriter', 'underwriter.name')
                ->sortable()
                ->searchable(),

            Column::make('Sum insured', 'sum_insured')
                ->sortable(),

            Column::make('Pol\' risk', 'political_risk')
                ->sortable(),

            Column::make('Excess pro\'', 'excess_protector')
                ->sortable(),

            Column::make('Basic premium', 'basic_premium')
                ->sortable()
                ->searchable(),

            Column::make('Total premium', 'annual_total_premium')
                ->sortable(),

            Column::make('Expiry date', 'annual_expiry_date_formatted', 'annual_expiry_date')
                ->sortable(),

            Column::make('Renewal date', 'annual_renewal_date_formatted', 'annual_renewal_date')
                ->sortable(),

            Column::make('Updated at', 'updated_at_formatted', 'updated_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array {
        return [
            Filter::inputText('full_names')->operators(['contains']),
            Filter::inputText('policy_number')->operators(['contains']),
            Filter::inputText('risk_id')->operators(['contains']),

            Filter::multiSelect('insurance.name', 'insurance_id')
                ->dataSource(Insurance::all())
                ->optionValue('id')
                ->optionLabel('name'),


            Filter::multiSelect('underwriter.name', 'underwriter_id')
                ->dataSource(Underwriter::all())
                ->optionValue('id')
                ->optionLabel('name'),


            Filter::datepicker('annual_expiry_date'),
            Filter::datepicker('annual_renewal_date'),
            Filter::datetimepicker('created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Client Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array {
        return [  
            Button::make('view', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>')
                ->class('cursor-pointer text-blue-500 text-sm')
                ->emitTo('clients', 'viewClientListener', fn (Client $model) => ['id' => $model->id]),

            Button::make('edit', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>')
                ->class('cursor-pointer text-green-500 text-sm')
                ->emitTo('clients','updateClientListener', fn (Client $model) => ['id' => $model->id]),

            Button::make('delete', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4" x-tooltip="tooltip">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>')
                ->class('cursor-pointer text-red-500 text-sm')
                ->emitTo('clients','deleteClientListener', fn (Client $model) => ['id' => $model->id])
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Client Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($client) => $client->id === 1)
                ->hide(),
        ];
    }
    */
}
