<?php

namespace App\DataTables;

use App\Models\Coupon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class CouponDataTable extends DataTable
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

        return $dataTable->addColumn('description', function ($query) {
            return $query->description;
        })->addColumn('action', 'coupons.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
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
                    //    'extend' => 'create',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    // ],
                    // [
                    //    'extend' => 'export',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    // ],
                    // [
                    //    'extend' => 'print',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
                    // ],
                    // [
                    //    'extend' => 'reset',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    // ],
                    // [
                    //    'extend' => 'reload',
                    //    'className' => 'btn btn-default btn-sm no-corner',
                    //    'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
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
            'code' => new Column(['title' => __('models/coupons.fields.code'), 'data' => 'code']),
            'description' => new Column(['title' => __('models/coupons.fields.description'), 'data' => 'description']),
            'is_ratio' => new Column(['title' => __('models/coupons.fields.is_ratio'), 'data' => 'is_ratio']),
            'value' => new Column(['title' => __('models/coupons.fields.value'), 'data' => 'value']),
            'expiration_date' => new Column(['title' => __('models/coupons.fields.expiration_date'), 'data' => 'expiration_date'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'coupons_datatable_' . time();
    }
}
