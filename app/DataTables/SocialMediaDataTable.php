<?php

namespace App\DataTables;

use App\Models\SocialMedia;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class SocialMediaDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'social_media.datatables_actions')
        ->editColumn('icon',function ($query){
            return '<img src="'.dashboard_url($query['icon']).'" style="width: 50px;height: 50px;border-radius: 10%;">';
        })
        ->rawColumns(['action', 'id', 'icon']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SocialMedia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SocialMedia $model)
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
            'icon' => new Column(['title' => __('models/socialMedia.fields.icon'), 'data' => 'icon']),
            'key' => new Column(['title' => __('models/socialMedia.fields.key'), 'data' => 'key']),
            'url' => new Column(['title' => __('models/socialMedia.fields.url'), 'data' => 'url'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'social_media_datatable_' . time();
    }
}
