<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Enum\OrderStatus;
use App\Exports\ExportOrder;
use App\Http\Requests\{CreateOrderRequest, UpdateOrderRequest};
use App\Repositories\OrderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\{Coupon, Order, User};
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Response;

class OrderController extends AppBaseController
{
    private $orderRepository;
    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }
    public function index(OrderDataTable $orderDataTable)
    {
                $orderStatuses = array_combine(array_column(OrderStatus::cases(), 'value'), array_column(OrderStatus::cases(), 'name'));

        return $orderDataTable->render('orders.index',compact('orderStatuses'));
    }
    public function exportExcel()
    {
        $orders = Order::all();
        $lang = app()->getLocale();
        if (count($orders) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        return Excel::download(new ExportOrder($orders), 'Orders.XLSX');
    }
    public function exportPdf()
    {
        $orders = Order::all();
        $lang = app()->getLocale();
        if (count($orders) == 0) {
            $message = $lang == 'en' ? 'No any data to export' : 'لا يوجد اي بيانات لتصديرها';
            return redirect()->back()->with(['message' => $message]);
        }
        $pdf = Pdf::loadView('orders.pdf', compact('orders'));
        return $pdf->stream('orders.pdf');
    }
    public function exportOrderPdf()
    {
        $order = Order::find(request('id'));
        $lang = app()->getLocale();
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect()->back();
        }
        $pdf = Pdf::loadView('orders.order_pdf', compact('order'));
    }
    public function create()
    {
        $coupouns = Coupon::pluck('code', 'id');
        $users = User::where('user_type', 'client')->pluck('name', 'id');
        return view('orders.create')->with(['users' => $users, 'coupouns' => $coupouns]);
    }
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();
        $order = $this->orderRepository->create($input);
        $input['order_id'] = $order['id'];
        Flash::success(__('messages.saved', ['model' => __('models/orders.singular')]));
        return redirect(route('orders.index'));
    }
    public function show($id)
    {
        $order = $this->orderRepository->find($id);
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $orderStatuses = array_combine(array_column(OrderStatus::cases(), 'value'), array_column(OrderStatus::cases(), 'name'));

        return view('orders.show')->with(['order'=> $order,'order_statuses'=>$orderStatuses]);
    }
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $coupouns = Coupon::pluck('code', 'id');
        $users = User::where('user_type', 'client')->pluck('name', 'id');
        return view('orders.edit')->with(['order' => $order, 'users' => $users, 'coupouns' => $coupouns]);
    }
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $order = $this->orderRepository->update($request->all(), $id);
        $request['order_id'] = $order['id'];
        Flash::success(__('messages.updated', ['model' => __('models/orders.singular')]));
        return redirect(route('orders.index'));
    }
    public function addProduct()
    {
        $order = Order::where('id', request('order_id'))->first();
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $order->products()->attach(request('product_id'), [
            'product_option_key_id' => request('option_id'),
            'price' => request('price'),
            'purchase_price' => request('purchase_price'),
            'quantity' => request('quantity'),
        ]);
        $total_price = $order->products()->sum(\DB::raw('product_order.purchase_price*product_order.quantity'));
        $tax = ($order->coupon != null ? ($order->coupon->is_ratio ? (1 - $order->coupon->value) * $total_price : $total_price - $order->coupon->value) : $total_price) * 0.1;
        $final_price = $total_price + $tax - ($order->coupon != null ? ($order->coupon->is_ratio ? $order->coupon->value * $total_price : $order->coupon->value) : 0);
        $order->update([
            'total_price' => $total_price,
            'tax' => $tax,
            'final_price' => $final_price
        ]);
        Flash::success(__('awt.Add Product to Order Successfully'));
        return redirect(route('orders.show', request('order_id')));
    }
    public function editStatus()
    {
        $order = Order::where('id', request('order_id'))->first();
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $order->update([
            'order_status' => request('order_status')
        ]);
        Flash::success(__('awt.Updated Order Status Successfully'));
        if (request('type') == 'index')
            return redirect(route('orders.index'));
        return redirect(route('orders.show', request('order_id')));
    }
    public function destroyProduct()
    {
        $order = Order::where('id', request('order_id'))->first();
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $product = $order->products()->wherePivot('id', request('id'))->first();
        $order->products()->wherePivot('id', request('id'))->detach($product->id);
        Flash::success(__('awt.Deleted Product from Order Successfully'));
        return redirect(route('orders.show', request('order_id')));
    }
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);
        dd($order);
        if (empty($order)) {
            Flash::error(__('messages.not_found', ['model' => __('models/orders.singular')]));
            return redirect(route('orders.index'));
        }
        $this->orderRepository->delete($id);
        Flash::success(__('messages.deleted', ['model' => __('models/orders.singular')]));
        return redirect(route('orders.index'));
    }
}
