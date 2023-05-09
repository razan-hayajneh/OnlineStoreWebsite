<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class CategoryDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'categories.datatables_actions')
        ->addColumn('name', function ($query) {
            return $query->name;
        })
        ->editColumn('image',function ($query){
            return '<img src="'.dashboard_url($query['image_path']).'" style="width: 150px;height: 150px;border-radius: 10%;">';
        })
        ->editColumn('active',function ($query){
            return '<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success" style="direction: ltr">
                        <input type="checkbox" onchange="changeActive('.$query->id.')" '.($query->active == 1 ? 'checked' : '') .' class="custom-control-input" id="customSwitch'.$query->id.'">
                        <label class="custom-control-label" id="status_label'.$query->id.'" for="customSwitch'.$query->id.'"></label>
                    </div>';
        })
        ->rawColumns(['image','action','active']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->query();
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
                //     [
                //        'extend' => 'create',
                //        'className' => 'btn btn-default btn-sm no-corner',
                //        'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                //     ],
                //     [
                //        'extend' => 'export',
                //        'className' => 'btn btn-default btn-sm no-corner',
                //        'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                //     ],
                //     [
                //        'extend' => 'print',
                //        'className' => 'btn btn-default btn-sm no-corner',
                //        'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                //     ],
                //     [
                //        'extend' => 'reset',
                //        'className' => 'btn btn-default btn-sm no-corner',
                //        'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                //     ],
                //     [
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
            'name' => new Column(['title' => __('models/categories.fields.name'), 'data' => 'name']),
            // 'parent_id' => new Column(['title' => __('models/categories.fields.parent_id'), 'data' => 'parent_id']),
            'active' => new Column(['title' => __('models/categories.fields.active'), 'data' => 'active']),
            'image' => new Column(['title' => __('models/categories.fields.image'), 'data' => 'image'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categories_datatable_' . time();
    }
}
