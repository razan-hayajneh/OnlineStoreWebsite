<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ProductDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'products.datatables_actions')
        ->editColumn('image',function ($query){
            return '<img src="'.dashboard_url($query['image_path']).'" style="width: 150px;height: 150px;border-radius: 10%;">';
        })
        ->addColumn('description', function ($query) {
            return $query->description;
        })
        ->editColumn('discount_type',function ($query){
            if($query['discount_type']==0)
            return '' .__("models/products.fields.amount").'';
            else
            return '' .__("models/products.fields.ratio").'';
        })
        ->addColumn('option', function ($query) {
            return
                '<a href="' . route('product.optionKey', ['id' => $query->id]) . '">
                   <button   class="btn btn-success btn-round-2">
                       ' . __('option') . '
                   </button>
                </a>';
        })
        ->rawColumns(['image','option', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->query()
        ->where('category_id', $this->id);
        // return $model->newQuery();
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
            'name' => new Column(['title' => __('models/products.fields.name'), 'data' => 'name']),
            'image' => new Column(['title' => __('models/categories.fields.image'), 'data' => 'image']),
            'description' => new Column(['title' => __('models/products.fields.description'), 'data' => 'description']),
            'price' => new Column(['title' => __('models/products.fields.price'), 'data' => 'price']),
            // 'category_id' => new Column(['title' => __('models/products.fields.category_id'), 'data' => 'category_id']),
            'quantity' => new Column(['title' => __('models/products.fields.quantity'), 'data' => 'quantity']),
            'discount' => new Column(['title' => __('models/products.fields.discount'), 'data' => 'discount']),
            'discount_type' => new Column(['title' => __('models/products.fields.discount_type'), 'data' => 'discount_type']),
            'option' => new Column(['title' => __('models/products.fields.option'), 'data' => 'option']),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'products_datatable_' . time();
    }
}
