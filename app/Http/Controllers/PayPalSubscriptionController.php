<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PayPalSubscriptionController extends Controller
{
    // 1️⃣ Crear un plan de suscripción
    public function createPlan()
{
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();

    // 🛠️ 1. Crear el producto en PayPal
    $response = $provider->createProduct([
        'name' => 'Suscripción Mensual',
        'description' => 'Acceso premium al sistema',
        'type' => 'SERVICE',
        'category' => 'SOFTWARE'
    ]);

    if (isset($response['id'])) {
        $product_id = $response['id'];

        // 🛠️ 2. Crear el plan de suscripción
        $planResponse = $provider->createPlan([
            'product_id' => $product_id,
            'name' => 'Plan Mensual',
            'description' => 'Suscripción mensual recurrente',
            'billing_cycles' => [
                [
                    'frequency' => [
                        'interval_unit' => 'MONTH',
                        'interval_count' => 1
                    ],
                    'tenure_type' => 'REGULAR',
                    'sequence' => 1,
                    'total_cycles' => 0, // 0 = Sin límite
                    'pricing_scheme' => [
                        'fixed_price' => [
                            'value' => '3.00',
                            'currency_code' => 'USD'
                        ]
                    ]
                ]
            ],
            'payment_preferences' => [
                'auto_bill_outstanding' => true,
                'setup_fee' => [
                    'value' => '0',
                    'currency_code' => 'USD'
                ],
                'setup_fee_failure_action' => 'CANCEL',
                'payment_failure_threshold' => 1
            ],
        ]);

        return response()->json($planResponse);
    }

    return response()->json(['error' => 'No se pudo crear el plan']);
}


    // 2️⃣ Suscribirse a un plan
    public function subscribeToPlan($plan_id)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createSubscription([
            'plan_id' => $plan_id,
            'subscriber' => [
                'name' => [
                    'given_name' => 'Usuario',
                    'surname' => 'Demo'
                ],
                'email_address' => 'comprador@example.com'
            ],
            'application_context' => [
                'return_url' => route('paypal.subscription.success'),
                'cancel_url' => route('paypal.subscription.cancel'),
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('paypal.subscription.cancel');
    }

    // 3️⃣ Confirmar suscripción
    public function successSubscription(Request $request)
{
    // Obtén los datos de la suscripción desde PayPal
    $paypal_subscription_id = $request->query('subscription_id'); // Asegúrate de que PayPal envía esto
    $status = 'ACTIVE'; // PayPal normalmente envía el estado
    $start_date = Carbon::now();
    $next_billing_date = Carbon::now()->addMonth(); // Suponiendo pago mensual

    // Guardar la suscripción en la BD
    Subscription::create([
        'user_id' => Auth::id(),
        'paypal_subscription_id' => $paypal_subscription_id,
        'status' => $status,
        'start_date' => $start_date,
        'next_billing_date' => $next_billing_date
    ]);

    return redirect()->route('nuevasuscripcion')->with('success', 'Suscripción registrada exitosamente');
}

    // 4️⃣ Cancelar suscripción
    public function cancelSubscription()
    {
        return redirect()->route('dashborad')->with('error', 'Suscripción cancelada');
    }
}
