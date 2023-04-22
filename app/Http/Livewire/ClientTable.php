<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ClientTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()
                          ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
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
    public function datasource(): Builder
    {
        return Client::query();
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
    public function relationSearch(): array
    {
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
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('full_names')
            ->addColumn('policy_number')
            ->addColumn('risk_id')
            ->addColumn('insurance_id')
            ->addColumn('underwriter_id')
            ->addColumn('sum_insured')
            ->addColumn('political_risk')
            ->addColumn('excess_protector')
            ->addColumn('basic_premium')
            ->addColumn('annual_total_premium')
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
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Full names', 'full_names')
                ->sortable()
                ->searchable(),

            Column::make('Policy No', 'policy_number')
                ->sortable()
                ->searchable(),

            Column::make('Risk id', 'risk_id')
                ->sortable()
                ->searchable(),

            Column::make('Insurance id', 'insurance_id'),
            Column::make('Underwriter id', 'underwriter_id'),
            Column::make('Sum insured', 'sum_insured')
                ->sortable()
                ->searchable(),

            Column::make('Political risk', 'political_risk')
                ->sortable()
                ->searchable(),

            Column::make('Excess protector', 'excess_protector')
                ->sortable()
                ->searchable(),

            Column::make('Basic premium', 'basic_premium')
                ->sortable()
                ->searchable(),

            Column::make('Total premium', 'annual_total_premium')
                ->sortable()
                ->searchable(),

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
    public function filters(): array
    {
        return [
            Filter::inputText('full_names')->operators(['contains']),
            Filter::inputText('policy_number')->operators(['contains']),
            Filter::inputText('risk_id')->operators(['contains']),
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

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('client.edit', function(\App\Models\Client $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('client.destroy', function(\App\Models\Client $model) {
                    return $model->id;
               })
               ->method('delete')
        ];
    }
    */

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
