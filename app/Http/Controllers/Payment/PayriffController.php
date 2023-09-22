<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Utils\Services\PaymentService;
use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PayriffController extends Controller
{
    public function inCart(Request $request, PaymentService $paymentGateway)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => Auth::guard('customer')->check() ? ['string', 'max:15'] : ['required', 'string', 'max:15'],
            'last_name' => Auth::guard('customer')->check() ? ['string', 'max:15'] : ['required', 'string', 'max:15'],
            'gender' => Auth::guard('customer')->check() ? 'filled' : 'nullable',
            'email' => Auth::guard('customer')->check() ? 'email|max:40' : 'required|email|max:40|unique:customers,email',
            'phone_number' => Auth::guard('customer')->check() ? 'numeric|digits_between:1,15' : 'required|numeric|digits_between:1,15',

            'city_id' => 'required|exists:cities,id',
            'region_id' => 'required|exists:regions,id',
            'address' => 'required',

            'payment_method_id' => 'required|exists:payment_methods,id',
            'terms' => 'accepted',
        ]);


        if ($validator->passes()) {

            DB::beginTransaction();
            try {

                list($items, $total) = $this->checkCart();
                $user = $this->getUser($request);
                $order = $this->createOrder($user, $total, $request, $items);

                if ($order->payment_method_id == $order::Payriff) {

                    $paymentPageUrl = $paymentGateway->createOrder(
                        $order['total_amount'],             // amount
                        $order['id'],    // description
                        'AZN',             // currency
                        'AZ',               // language
                        route('payriff.paymentApproved'),   // aprroveUrl
                        route('payriff.paymentCanceled'),   // cancelUrl
                        route('payriff.paymentDeclined')   // declineUrl
                    );
                    DB::commit();

                    $paymentUrl = $paymentPageUrl->paymentUrl;

                    $order_id = $paymentPageUrl->orderId;
                    $session_id = $paymentPageUrl->sessionId;

                    $order->update([
                        'order_id' => $order_id,
                        'session_id' => $session_id,
                    ]);
                    return redirect($paymentUrl);

                } else if ($order->payment_method_id == $order::Cash) {
                    $order->update(['order_status_id' => $order::StatusPending]);

                    $this->sendMail($order);

                    if ($order->delivery_method_id == $order::ByStarex) {
                        $starexpress->storePickupPackage($order);
                    }
                    DB::commit();

                    return view('frontend.payment.cash_success');
                } else if ($order->payment_method_id == $order::BirKart) {

                    $paymentPageUrl = $paymentGateway->createİnstallMent(
                        $order['total_amount'],           // amount
                        $order['id'],                    // description
                        'AZN',               // currency
                        'AZ',                 // language
                        3,              //Period
                        'BIRKART', //Type

                        route('payriff.paymentApproved'),   // aprroveUrl
                        route('payriff.paymentCanceled'),   // cancelUrl
                        route('payriff.paymentDeclined')   // declineUrl
                    );
                    DB::commit();

                    $paymentUrl = $paymentPageUrl->paymentUrl;

                    $order_id = $paymentPageUrl->orderId;
                    $session_id = $paymentPageUrl->sessionId;

                    $order->update([
                        'order_id' => $order_id,
                        'session_id' => $session_id,
                    ]);
                    return redirect($paymentUrl);


                } else {
                    DB::rollBack();
                    return view('frontend.payment.error');
                }


            } catch (\Exception $e) {
                DB::rollback();
                alert()->error(__('static.something_went_wrong'), __('static.your_order_hasnt_accepted'));
                Log::channel('backend')->error($e->getMessage());
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    /**
     * @throws \Exception
     */

    public function paymentApproved(Request $request, StarexpressService $starexpress)
    {
        if ($request->isMethod('post')) {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!empty($data['code']) && $data['code'] == '00000') {
                $order_id = $data['payload']['orderDescription'];
                $order = Order::findOrFail($order_id);
                $order->update(['order_status_id' => $order::StatusApproved]);
                //$this->sendMail($order);

                if ($order->delivery_method_id == $order::ByStarex) {
                    $starexpress->storePickupPackage($order);
                }
            }
        }

        return view('frontend.payment.success');
    }

    public function paymentDeclined(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!empty($data['code']) && $data['code'] != '00000') {
                $order_id = $data['payload']['orderDescription'];
                $order = Order::findOrFail($order_id);
                $order->update(['order_status_id' => $order::StatusFailed]);
            }
        }

        return view('frontend.payment.error');
    }

    public function paymentCanceled(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!empty($data['code']) && $data['code'] != '00000') {
                $order_id = $data['payload']['orderDescription'];
                $order = Order::findOrFail($order_id);
                $order->update(['order_status_id' => $order::StatusCancelled]);
            }
        }

        return view('frontend.payment.error');

    }

    protected function getCartResultForView($items)
    {
        $result = [];
        $total = 0;

        if (auth('customer')->check()) {
            foreach ($items as $item) {
                $product = Product::find($item->pivot->product_id);
                $quantity = Cart::where(['customer_id' => customer()->id, 'product_id' => $product->id])->first()->qty;
                $price = $product->price;
                $discount_price = $product->discount_price;

                $result[] = [

                    'id' => $product->id,
                    'image' => $product->image,
                    'image_alt' => $product->image_alt,
                    'name' => $product->translate(locale())->name,
                    'slug' => $product->slug,
                    'quantity' => $product->quantity,
                    'quantity_type' => $product->quantity_type,
                    'qty' => $quantity,
                    'price' => round($price, 2),
                    'discount_price' => round($discount_price, 2)
                ];

                $total += $price * $quantity;
            }

            return ['items' => $result, 'total' => round($total, 2)];
        }

        if (Cookie::has(Cart::COOKIE_NAME)) {
            foreach ($items as $item) {
                $product = Product::find($item->product_id);
                $price = $product->price;
                $discount_price = $product->discount_price;

                $result[] = [

                    'id' => $item->product_id,
                    'image' => $product->image,
                    'image_alt' => $product->image_alt,
                    'name' => $product->translate(locale())->name,
                    'slug' => $product->slug,
                    'quantity' => $product->quantity,
                    'quantity_type' => $product->quantity_type,
                    'qty' => $item->qty,
                    'price' => round($price, 2),
                    'discount_price' => round($discount_price, 2)
                ];

                $total += $price * $item->qty;
            }

            return ['items' => $result, 'total' => round($total, 2)];
        }
    }

    /**
     * @return array
     */
    protected function checkCart(): array
    {
        if (auth('customer')->check()) {
            $cart = customer()->cartProducts;
            $items = $this->getCartResultForView($cart)['items'];
            $total = $this->getCartResultForView($cart)['total'];
        } else {
            $cart = json_decode(Cookie::get(Cart::COOKIE_NAME));
            $items = $this->getCartResultForView($cart)['items'];
            $total = $this->getCartResultForView($cart)['total'];
        }

        $this->cartClean();

        return array($items, $total);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getUser(Request $request)
    {
        $user = Customer::firstOrCreate(
            [
                'email' => $request->email ?? customer()->email,
            ],

            [
                'fullname' => $request->first_name . ' ' . $request->last_name,
                'gender' => $request->gender ?? customer()->gender,
                'email' => $request->email ?? customer()->email,
                'phone_number' => $request->phone_number ?? customer()->phone_number,
                'password' => ''
            ]
        );
        $user->addresses()->updateOrCreate(
            [
                'fullname' => $user->fullname,
                'region_id' => $request->region_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
            ],

            [
                'fullname' => $user->fullname,
                'region_id' => $request->region_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'default' => 1,
            ]
        );
        return $user;
    }

    /**
     * @param $user
     * @param $total
     * @param Request $request
     * @param $items
     * @return mixed
     */
    protected function createOrder($user, $total, Request $request, $items)
    {
        $order = Order::create([
            'customer_id' => $user->id,
            'amount' => $total,
            'order_status_id' => 1,
            'status' => 1
        ]);

        foreach ($items as $item) {
            $order->products()->create([
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => empty($item['discount_price']) ? $item['price'] : $item['discount_price'],
                'quantity' => $item['qty'],
                'subtotal_amount' => empty($item['discount_price']) ? $item['price'] * $item['qty'] : $item['discount_price'] * $item['qty']
            ]);
        }
        return $order;
    }

    /**
     * @return void
     */
    protected function cartClean(): void
    {
        if (auth('customer')->check()) {
            customer()->cartProducts()->detach();
        } else {
            Cookie::queue(Cookie::forget(Cart::COOKIE_NAME));
        }
    }

    /**
     * @param $order
     * @return void
     */
    protected function sendMail($order): void
    {
        $phone = setting("phone") ?? "";
        $email = setting("email") ?? "";

        $Informations = [
            'phone' => $phone,
            'email' => $email,
        ];

        $order->customer->notify(new InvoiceOrderNotification($order, $Informations));
        $admin = Admin::where('role_id', 1)->first();
        $admin->notify(new NewOrderNotification($admin));
    }

}
