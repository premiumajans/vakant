<?php

namespace App\Utils\Services;

use Illuminate\Support\Facades\Http;

class PaymentService
{
    protected string $merchantSecretKey;
    protected string $merchantUniqueNumber;
    protected string $encryptionToken;
    protected string $authorization;
    protected string $baseUrl;
    protected ?string $orderId = null;
    protected ?string $sessionId = null;

    public const SUCCESS = "00000";
    public const WARNING = "01000";
    public const ERROR = "15000";
    public const INVALID_PARAMETERS = "15400";
    public const UNAUTHORIZED = "14010";
    public const TOKEN_NOT_PRESENT = "14013";
    public const INVALID_TOKEN = "14014";

    public function __construct($orderId = null, $sessionId = null)
    {
//        $this->merchantSecretKey = config('app.payriff_secret');
//        $this->merchantUniqueNumber = config('app.payriff_number');
        $this->merchantSecretKey = 'AD30294EF68E428793B5834C4E15DDDF';
        $this->merchantUniqueNumber = 'ES1092103';
        $this->encryptionToken = time() . rand();
        $this->authorization = sha1($this->merchantSecretKey . $this->encryptionToken);
        $this->baseUrl = "https://api.payriff.com/api/v2/";
        $this->orderId = $orderId;
        $this->sessionId = $sessionId;
    }

    public function setOrderId($value): void
    {
        $this->orderId = $value;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setSessionId($value): void
    {
        $this->sessionId = $value;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function sendRequest($method, $body): ?object
    {
        return
            Http::withHeaders([
                "Authorization" => $this->authorization,
            ])->post($this->baseUrl . $method, [
                "body" => $body,
                "encryptionToken" => $this->encryptionToken,
                "merchant" => $this->merchantUniqueNumber
            ])->object();
    }
    public function createOrder(
        float   $amount,
        ?string $description = null,
        string  $currencyType = 'AZN',
        string  $language = 'AZ',
        ?string $approveURL = null,
        ?string $cancelURL = null,
        ?string $declineURL = null
    )
    {
        $body = [
            "amount" => $amount,
            "approveURL" => $approveURL,
            "cancelURL" => $cancelURL,
            "currencyType" => $currencyType,
            "declineURL" => $declineURL,
            "description" => $description,
            "language" => $language,
            "installmentPeriod" => 0,
            "installmentProductType" => "BIRKART",
        ];

        $response = $this->sendRequest('createOrder', $body);

        if ($response->code == self::SUCCESS) {
            $this->setOrderId($response->payload->orderId);
            $this->setSessionId($response->payload->sessionId);

            return $response->payload;
        }
        return $response;
    }

    public function getOrderInformation(
        string  $language = 'AZ',
        ?string $orderId = null,
        ?string $sessionId = null
    ): ?object
    {
        $body = [
            "languageType" => $language,
            "orderId" => $orderId ?? $this->orderId,
            "sessionId" => $sessionId ?? $this->sessionId,
        ];

        $response = $this->sendRequest('getOrderInformation', $body);

        if ($response->code == self::SUCCESS) {
            return $response->payload;
        }

        return null;
    }

    public function getStatusOrder(
        string  $language = 'AZ',
        ?string $orderId = null,
        ?string $sessionId = null
    ): bool|string
    {
        $body = [
            "language" => $language,
            "orderId" => $orderId ?? $this->orderId,
            "sessionId" => $sessionId ?? $this->sessionId,
        ];

        $response = $this->sendRequest('getStatusOrder', $body);

        if ($response->code == self::SUCCESS) {
            return $response->payload->orderStatus;
        }

        return false;
    }

    public function refund(
        float   $refundAmount,
        ?string $orderId = null,
        ?string $sessionId = null
    ): string
    {
        $body = [
            "refundAmount" => $refundAmount,
            "orderId" => $orderId ?? $this->orderId,
            "sessionId" => $sessionId ?? $this->sessionId,
        ];
        $response = $this->sendRequest('refund', $body);
        return $response->internalMessage;
    }

    public function preAuth(
        float   $amount,
        ?string $description = null,
        string  $currencyType = 'AZN',
        string  $language = 'AZ',
        ?string $approveURL = null,
        ?string $cancelURL = null,
        ?string $declineURL = null
    ): string
    {
        $body = [
            "amount" => $amount,
            "approveURL" => $approveURL,
            "cancelURL" => $cancelURL,
            "currencyType" => $currencyType,
            "declineURL" => $declineURL,
            "description" => $description,
            "language" => $language
        ];

        $response = $this->sendRequest('preAuth', $body);

        if ($response->code == self::SUCCESS) {
            $this->setOrderId($response->payload->orderId);
            $this->setSessionId($response->payload->sessionId);

            return $response->payload->paymentUrl;
        }

        return view('frontend.payment.error');
    }

    public function reverse(
        float   $amount,
        ?string $description = null,
        string  $language = 'AZ',
        ?string $orderId = null,
        ?string $sessionId = null
    ): string
    {
        $body = [
            "amount" => $amount,
            "description" => $description,
            "language" => $language,
            "orderId" => $orderId ?? $this->orderId,
            "sessionId" => $sessionId ?? $this->sessionId,
        ];

        $response = $this->sendRequest('reverse', $body);

        return $response->internalMessage;
    }

    public function completeOrder(
        float   $amount,
        ?string $description = null,
        string  $language = 'AZ',
        ?string $orderId = null,
        ?string $sessionId = null
    ): string
    {
        $body = [
            "amount" => $amount,
            "description" => $description,
            "language" => $language,
            "orderId" => $orderId ?? $this->orderId,
            "sessionId" => $sessionId ?? $this->sessionId,
        ];

        $response = $this->sendRequest('completeOrder', $body);

        return $response->internalMessage;
    }

    public function cardSave(
        float   $amount,
        ?string $description = null,
        string  $currencyType = 'AZN',
        string  $language = 'AZ',
        ?string $approveURL = null,
        ?string $cancelURL = null,
        ?string $declineURL = null
    )
    {
        $body = [
            "amount" => $amount,
            "approveURL" => $approveURL,
            "cancelURL" => $cancelURL,
            "currencyType" => $currencyType,
            "declineURL" => $declineURL,
            "description" => $description,
            "language" => $language
        ];

        $response = $this->sendRequest('cardSave', $body);

        if ($response->code == self::SUCCESS) {
            $this->setOrderId($response->payload->orderId);
            $this->setSessionId($response->payload->sessionId);

            return $response->payload->paymentUrl;
        }
    }

    public function autoPay(
        float   $amount,
        string  $cardUuid,
        ?string $description = null
    ): string
    {
        $body = [
            "amount" => $amount,
            "cardUuid" => $cardUuid,
            "description" => $description,
        ];

        $response = $this->sendRequest('autoPay', $body);

        return $response->internalMessage;
    }
}
