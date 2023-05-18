<?php

namespace App\DataTables;

use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class RatingDataTable extends DataTable
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
        return $dataTable->editColumn('product_id',function ($query){
            return $query->product['name'];
        })->rawColumns(['product_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ratings $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Rating $model)
    {
        return $model->groupBy('product_id')->with('product')->select('product_id',DB::raw('round(AVG(stars),2) as stars'))->newQuery();
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
                ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [],
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
            'product' => new Column(['title' => __('models/ratings.fields.product_id'), 'data' => 'product_id']),
            'stars' => new Column(['title' => __('models/ratings.fields.stars'), 'data' => 'stars'])
        ];
    }

}
