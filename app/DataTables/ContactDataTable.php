<?php

namespace App\DataTables;

use App\Models\Contact;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ContactDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'contacts.datatables_actions')->addColumn('location', function ($query) {
            return '<span style="width: 100px;height: 100px">' . $query->location . ' </span> ';
        })
        ->rawColumns(['location', 'action', 'id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
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
            'email' => new Column(['title' => __('models/contacts.fields.email'), 'data' => 'email']),
            'phone' => new Column(['title' => __('models/contacts.fields.phone'), 'data' => 'phone']),
            'phone2' => new Column(['title' => __('models/contacts.fields.phone2'), 'data' => 'phone2']),
            'googleStore' => new Column(['title' => __('models/contacts.fields.googleStore'), 'data' => 'googleStore']),
            'appStore' => new Column(['title' => __('models/contacts.fields.appStore'), 'data' => 'appStore']),
            'location' => new Column(['title' => __('models/contacts.fields.location'), 'data' => 'location']),
            // 'latitude' => new Column(['title' => __('models/contacts.fields.latitude'), 'data' => 'latitude']),
            'whatsapp' => new Column(['title' => __('models/contacts.fields.whatsapp'), 'data' => 'whatsapp'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'contacts_datatable_' . time();
    }
}
