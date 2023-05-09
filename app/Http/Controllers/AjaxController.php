<?php

namespace App\Http\Controllers;

use App\Enum\OrderStatus;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOptionKey;
use App\Models\Order;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\OptionKey;
use Laracasts\Flash\Flash;

class AjaxController extends Controller
{
    use ResponseTrait;
    public function getUser($id, Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($id);

            return $this->ApiResponse('success', '', $user);
        }
    }
    public function editOrderProductByQuantity(Request $request)
    {
        // dd($request);
        // if ($request->ajax()) {
        $order = Order::where('id', $request['order_id'])->first();
        $product = $order->products()->wherePivot('id', $request['id'])->first();
        $order->products()->wherePivot('id', $request['id'])->updateExistingPivot($product->id, ['quantity' => $request['quantity']]);
        $total_price = $order->products()->sum(\DB::raw('product_order.purchase_price*product_order.quantity'));
        $tax = ($order->coupon != null ? ($order->coupon->is_ratio ? (1 - $order->coupon->value) * $total_price : $total_price - $order->coupon->value) : $total_price) * 0.1;
        $final_price = $total_price + $tax - ($order->coupon != null ? ($order->coupon->is_ratio ? $order->coupon->value * $total_price : $order->coupon->value) : 0);
        $order->update([
            'total_price' => $total_price,
            'tax' => $tax,
            'final_price' => $final_price
        ]);
        Flash::success(__('awt.Quantity Edit Successfully'));
        return $this->successResponse($order);
        // }
    }
    public function getCategories(Request $request)
    {
        // if ($request->ajax()) {
        // $id = $request->id;
        // $user = User::find($id);
        $categories = Category::whereNull('parent_id')->where('active', 1)->pluck('name', 'id');
        return $this->successResponse($categories);
        // }
    }
    public function getSubCategories(Request $request)
    {
        // if ($request->ajax()) {
        // $id = $request->id;
        // $user = User::find($id);
        $categories = Category::where('parent_id', $request['id'])->where('active', 1)->pluck('name', 'id');
        return $this->successResponse($categories);
        // }
    }
    public function getOrderStatuses(Request $request)
    {
        $orderStatuses = array_combine(array_column(OrderStatus::cases(), 'value'), array_column(OrderStatus::cases(), 'name'));
        return $this->successResponse($orderStatuses);
    }
    public function getProducts(Request $request)
    {
        $products = Product::where('category_id', $request['id'])->pluck('name', 'id');
        return $this->successResponse($products);
    }
    public function getProductData(Request $request)
    {
        $options = ProductOptionKey::where('product_id',request('id'))->get();
        $newOptions = [];
        foreach ($options as $key => $value) {
            $newOptions[$value['id']]=$value->optionKey['key'];
        }        $product = Product::where('id', $request['id'])->first(['price', 'discount','discount_type','quantity']);
        return $this->successResponse(['product'=>$product,'options'=>$newOptions]);
    }
    public function getOptionData(Request $request)
    {
        $option = ProductOptionKey::where('id',request('id'))->first();
        $option->price += $option->product['price'];
        return $this->successResponse($option);
    }
    public function changeAccepted(Request $request)
    {
        $product = User::find($request['id']);
        if ($product->accepted == 1) {
            $product->accepted = 0;
        } else {
            $product->accepted = 1;
        }
        $product->save();
        return response()->json($product->accepted);
    }

    // public function getNotificationCount(Request $request)
    // {
    //     $user = auth()->user();
    //     $unreadNotifications = $user->unreadnotifications()->count();
    //     return response()->json($unreadNotifications);
    // }
    // public function getMessagesNotificationCount(Request $request)
    // {
    //     $count = Message_notification::whereRaw('created_at IN (select MAX(created_at) FROM message_notifications GROUP BY room_id)')->where('is_seen', 0)->where('is_sender', 0)->where('user_id', auth()->id())->count();
    //     return response()->json($count);
    // }


    public function getOptionKey(Request $request)
    {
        $id=$request->id;
        $option_key= OptionKey::where('option_id', $id)->get();
        return $this->successResponse($option_key);
    }
}
