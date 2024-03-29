<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ClientDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'clients.datatables_actions')->addColumn('user_status', function ($query) {
            return $query->user->user_status == 'active' ? '<button  class="btn btn-success btn-round-2">
            ' . __('models/clients.fields.'.$query->user->user_status) . '
          </button>'
                : '<button  class="btn btn-danger btn-round-2">
            ' . __('models/clients.fields.'.$query->user->user_status) . '
          </button>';
        })
            ->editColumn('avatar', function ($query) {
                return '<div class="row"><img src="' . dashboard_url($query->user['profile_photo_path']) . '" style="width: 100px;height: 100px;border-radius: 100%;"><span style="margin: 7px;align-self: center;"><div>' . $query->user['name'] . '<div>' . $query->user['email'] . '</div></span></div>';
            })
            ->editColumn('name', function ($query) {
                return $query->first_name . ' ' . $query->last_name ;
            })
            ->rawColumns(['user_status', 'action', 'id', 'avatar']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->query()->with('user');
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
        $lang = app()->getLocale();
        return [
            Column::make('avatar')->title(__('models/clients.fields.avatar'))->searchable(false)->orderable(false),
            'name' => new Column(['title' => __('models/clients.fields.name'), 'data' => 'name']),
            'phone' => new Column(['title' => __('models/clients.fields.phone'), 'data' => 'phone']),
            'user_status' => new Column(['title' => __('models/clients.fields.user_status'), 'data' => 'user_status']),
            'address' => new Column(['title' => __('models/clients.fields.address'), 'data' => 'address']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clients_datatable_' . time();
    }
}
