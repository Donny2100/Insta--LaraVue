<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Subscription;
use App\Helpers\StripeHelper;

class PaymentInfoController extends Controller {
    public function index() {
        $defaultPaymentMethod = auth()->user()->defaultPaymentMethod();
        $paymentMethods       = auth()->user()->paymentMethods();
        $intent               = auth()->user()->createSetupIntent();
        $subscriptions        = auth()->user()->subscriptions()->active()->get();
        $plans                = StripeHelper::getPrices();

        return view('frontend.user.user_payment', compact(['intent', 'paymentMethods', 'subscriptions', 'defaultPaymentMethod', 'plans']));
    }

    public function subscribe(Request $request) {
        $defaultPaymentMethod = auth()->user()->defaultPaymentMethod();

        try {
            $stripePrice = StripeHelper::getPrice($request->id);
            if ((!auth()->user()->subscription('Premium Plan') || !auth()->user()->subscription('Premium Plan')->cancelled()) && $stripePrice->recurring->trial_period_days) {
                auth()->user()
                      ->newSubscription('Premium Plan', $request->id)
                      ->trialDays($stripePrice->recurring->trial_period_days)
                      ->create($defaultPaymentMethod->id);
            } else {
                auth()->user()
                      ->newSubscription('Premium Plan', $request->id)
                      ->create($defaultPaymentMethod->id);
            }

            return back()->with('success', 'You have been successfully subscribed.');
        } catch (\Throwable $th) {
            return back()->with('error', 'There was an error with your subscription process.');
        }
    }

    public function setDefaultPayment(Request $request) {
        try {
            auth()->user()->updateDefaultPaymentMethod($request->id);
            return back()->with('success', 'Default payment method updated.');
        } catch (\Throwable $th) {
            return back()->with('error', 'There was an error updating your default payment method.');
        }
    }

    public function resumeSubscription() {
        try {
            auth()->user()->subscription('Premium Plan')->resume();
            return back()->with('success', 'Subscription successfully resumed.');
        } catch (\Throwable $th) {
            return back()->with('error', 'There was an error resuming your subscription.');
        }

        return redirect()->route('payment_info');
    }

    public function cancelSubscription() {
        try {
            auth()->user()->subscription('Premium Plan')->cancel();

            return back()->with('success', 'Subscription successfully cancelled.');
        } catch (\Throwable $th) {
            return back()->with('error', 'There was an error cancelling your subscription.');
        }
    }

    public function addCard(Request $request) {
        try {
            $newPaymentMethod = auth()->user()->addPaymentMethod($request->payment_method);

            auth()->user()->updateDefaultPaymentMethod($newPaymentMethod->id);

            return back()->with('success', 'Payment info updated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'There was an error updating your payment info.');
        }
    }

    public function removeCard(Request $request) {
        try {
            $paymentMethod = auth()->user()->findPaymentMethod($request->id);
            $paymentMethod->delete();

            return back()->with('success', 'Payment method removed successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'There was an error removing your payment method.');
        }

        return redirect()->route('payment_info');
    }
}
