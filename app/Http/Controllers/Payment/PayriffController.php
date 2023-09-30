<?php


namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Utils\Enums\OrderTypeEnum;
use App\Utils\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PayriffController extends Controller
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        return $this->paymentService->createOrder(1, 1, 'AZN', 'AZ', route('paymentApproved'), route('paymentCanceled'), route('paymentDeclined'));
    }

    public function payPackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return 'Validation failed';
        }

        try {
            $order = $this->createOrder($request->user_id, $request->amount, OrderTypeEnum::PACKAGE);

            $paymentPageUrl = $this->generatePaymentPageUrl($order->amount, $order->id);

            return redirect($paymentPageUrl->paymentUrl);
        } catch (\Exception $exception) {
            return 'error';
        }
    }

    public function paySelection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return 'validation-failed';
        }

        try {
            $orderType = $request->input('order_type') == OrderTypeEnum::SINGLE_VIP ? OrderTypeEnum::SINGLE_VIP : OrderTypeEnum::SINGLE_PREMIUM;

            $order = $this->createOrder($request->user_id, $request->amount, $orderType);

            $paymentPageUrl = $this->generatePaymentPageUrl($order->amount, $order->id);

            return redirect($paymentPageUrl->paymentUrl);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function createOrder($userId, $amount, $orderType, $packageId = null)
    {
        return DB::transaction(function () use ($userId, $amount, $orderType, $packageId) {
            $orderData = [
                'customer_id' => $userId,
                'amount' => $amount,
                'order_type' => $orderType,
                'order_status_id' => 1,
                'status' => 1,
            ];

            if ($orderType === OrderTypeEnum::PACKAGE) {
                $orderData['package_id'] = $packageId;
            }

            return Order::create($orderData);
        });
    }


    private function generatePaymentPageUrl($amount, $orderId)
    {
        return $this->paymentService->createOrder(
            $amount,
            $orderId,
            'AZN',
            'AZ',
            route('paymentApproved'),
            route('paymentCanceled'),
            route('paymentDeclined')
        );
    }
}
