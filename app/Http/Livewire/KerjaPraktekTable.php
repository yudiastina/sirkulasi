<?php

namespace App\Http\Livewire;

use App\Models\KerjaPraktek;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class KerjaPraktekTable extends PowerGridComponent
{
    use ActionButton;

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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
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
     * @return Builder<\App\Models\KerjaPraktek>
     */
    public function datasource(): Builder
    {
        return KerjaPraktek::query();
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
            // ->addColumn('id')
            ->addColumn('THNAKA')

            /** Example of custom column using a closure **/
            ->addColumn('THNAKA_lower', function (KerjaPraktek $model) {
                return strtolower(e($model->THNAKA));
            })

            ->addColumn('Periode')
            ->addColumn('nim')
            ->addColumn('DOSEN_PEMB')
            ->addColumn('nmdosen')
            ->addColumn('judul_final')
            // ->addColumn('link_laporan_final')
            // ->addColumn('link_pendahuluan')
            // ->addColumn('link_bab1')
            // ->addColumn('link_bab2')
            // ->addColumn('link_bab3')
            // ->addColumn('link_bab4')
            // ->addColumn('link_bab5')
            // ->addColumn('link_bab6')
            // ->addColumn('link_daftar_pustaka')
            // ->addColumn('akses_user')
            // ->addColumn('created_at_formatted', fn (KerjaPraktek $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            // ->addColumn('updated_at_formatted', fn (KerjaPraktek $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ;
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
            // Column::make('ID', 'id')
            //     ->makeInputRange(),

            Column::make('THNAKA', 'THNAKA')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PERIODE', 'Periode')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('NIM', 'nim')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            // Column::make('DOSEN PEMB', 'DOSEN_PEMB')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            Column::make('NMDOSEN', 'nmdosen')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('JUDUL FINAL', 'judul_final')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            // Column::make('LINK LAPORAN FINAL', 'link_laporan_final')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK PENDAHULUAN', 'link_pendahuluan')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK BAB1', 'link_bab1')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK BAB2', 'link_bab2')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK BAB3', 'link_bab3')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK BAB4', 'link_bab4')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK BAB5', 'link_bab5')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK BAB6', 'link_bab6')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('LINK DAFTAR PUSTAKA', 'link_daftar_pustaka')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('AKSES USER', 'akses_user')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            // Column::make('CREATED AT', 'created_at_formatted', 'created_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

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
     * PowerGrid KerjaPraktek Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('lihat', 'Lihat')
                ->target('')
                ->class('bg-indigo-400 hover:bg-indigo-600  cursor-pointer text-white px-3 py-1.5 m-2  rounded text-sm')
                ->route('admin.kp.show', ['kerjaPraktek' => 'id']),

            Button::make('edit', 'Edit')
                ->target('')
                ->class('bg-yellow-400 hover:bg-yellow-600 text-white cursor-pointer px-3 py-1.5 m-2  rounded text-sm')
                ->route('admin.kp.edit', ['kerjaPraktek' => 'id']),

            Button::make('destroy', 'Delete')
                ->class('bg-red-600 hover:bg-red-800 cursor-pointer text-white px-3 py-1.5 m-2 rounded text-sm')
                ->openModal('kerja-praktek.delete-kerja-praktek',  ['kerjaPraktekId' => 'id']),
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
     * PowerGrid KerjaPraktek Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($kerja-praktek) => $kerja-praktek->id === 1)
                ->hide(),
        ];
    }
    */
}
