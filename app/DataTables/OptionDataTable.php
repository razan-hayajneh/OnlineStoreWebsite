<?php

namespace App\DataTables;

use App\Models\Option;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class OptionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);


        return $dataTable->addColumn('action', 'options.datatables_actions')
            // ->addColumn('option_keys', 'partial.optionKeysButton')
            ->addColumn('name', function ($query) {
                return $query->name;
            })
            ->addColumn('option_keys', function ($query) {
                return
                    '  <a href="' . route('optionKeys.index', ['id' => $query->id]) . '">
<button   class="btn btn-success btn-round-2">
  ' . __('option keys') . ' 
  </button>
</a>';
            })
            ->rawColumns(['option_keys', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Option $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Option $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // [
                    //     'extend' => 'create',
                    //     'className' => 'btn btn-default btn-sm no-corner',
                    //     'text' => '<i class="fa fa-plus"></i> ' . __('auth.app.create') . ''
                    // ],
                    // [
                    //     'extend' => 'export',
                    //     'className' => 'btn btn-default btn-sm no-corner',
                    //     'text' => '<i class="fa fa-download"></i> ' . __('auth.app.export') . ''
                    // ],
                    // [
                    //     'extend' => 'print',
                    //     'className' => 'btn btn-default btn-sm no-corner',
                    //     'text' => '<i class="fa fa-print"></i> ' . __('auth.app.print') . ''
                    // ],
                    // [
                    //     'extend' => 'reset',
                    //     'className' => 'btn btn-default btn-sm no-corner',
                    //     'text' => '<i class="fa fa-undo"></i> ' . __('auth.app.reset') . ''
                    // ],
                    // [
                    //     'extend' => 'reload',
                    //     'className' => 'btn btn-default btn-sm no-corner',
                    //     'text' => '<i class="fa fa-refresh"></i> ' . __('auth.app.reload') . ''
                    // ],
                ],
                'language' => [
                    'url' => url('//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json'),
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name' => new Column(['title' => __('models/options.fields.name'), 'data' => 'name']),
            'option_keys' => new Column(['title' => 'Option Keys', 'data' => 'option_keys'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'options_datatable_' . time();
    }
}
