<?php

namespace App\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    public function handleInvoicePaymentSucceeded($payload)
    {
        // Handle successful payment event
    }
}
