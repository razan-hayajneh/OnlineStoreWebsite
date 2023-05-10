<?php

namespace App\DataTables;

use App\Enum\OrderStatus;
use App\Models\Order;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class OrderDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'orders.datatables_actions')
            ->addColumn('coupon_code', function ($query) {
                return $query->coupon?($query->coupon?->is_ratio?$query->coupon?->value.'%': $query->coupon?->value.'JD'):'<button  class="btn btn-warning btn-round-2">without coupon</button>';
            })->addColumn('user_name', function ($query) {
                return $query->user?->name;
            })->addColumn('order_status', function ($query) {
                return $query->order_status;
            })->addColumn('status', function ($query) {
                return $query->order_status == OrderStatus::ACCEPTED ? '<button  class="btn btn-primary btn-round-2">
            ' . $query->order_status . '
          </button>'
                    : ($query->order_status == OrderStatus::CREATED ? '<button  class="btn btn-info btn-round-2">
            ' . $query->order_status . '
          </button>' : ($query->order_status == OrderStatus::REJECTED ? '<button  class="btn btn-danger btn-round-2">
            ' . $query->order_status . '
          </button>' :($query->order_status == OrderStatus::FINISHED ? '<button  class="btn btn-success btn-round-2">
            ' . $query->order_status . '
          </button>' : '<button  class="btn btn-warning btn-round-2">
            ' . $query->order_status . '
          </button>')));
            })
            ->rawColumns(['user_name','coupon_code','status','order_status', 'action', 'id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->query()->whereCheckout(1)->whereCanceled(0)->with(['coupon','user'])->latest();
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
            'user_name' => new Column(['title' => __('models/orders.fields.user_id'), 'data' => 'user_name']),
            'order_status' => new Column(['title' => __('awt.Order Status'), 'data' => 'status']),
            'total_price' => new Column(['title' => __('models/orders.fields.total_price'), 'data' => 'total_price']),
            'coupon_code' => new Column(['title' => __('models/coupons.singular'), 'data' => 'coupon_code']),
            'tax' => new Column(['title' => __('models/orders.fields.tax'), 'data' => 'tax']),
            'final_price' => new Column(['title' => __('models/orders.fields.final_price'), 'data' => 'final_price'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'orders_datatable_' . time();
    }
}
