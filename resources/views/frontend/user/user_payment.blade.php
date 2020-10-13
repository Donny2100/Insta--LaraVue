@extends('frontend.layouts.template')
@section('main')
    <main id="main" class="site-main">
        <div class="site-content">
            <div class="member-menu">
                <div class="container">
                    @include('frontend.user.user_menu')
                </div>
            </div>


            <div class="container">
                <div class="member-wrap">
                    <h1>Payment Info</h1>
                    @include('frontend.common.box-alert')

                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">Payment methods</h4>
                        </div>
                        <div class="card-body">
                            @if (count($paymentMethods) > 0)
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row payment-card">
                                            <div class="col-3">CARD BRAND</div>
                                            <div class="col-3">CARD NUMBER</div>
                                            <div class="col-3">EXPIRATION DATE</div>
                                            <div class="col-3">ACTIONS</div>
                                        </div>
                                    </li>
                                    @if($defaultPaymentMethod)
                                        <li class="list-group-item default-payment">
                                            <div class="row payment-card">
                                                <div class="col-3">
                                                    <span class="card-brand">{{ $defaultPaymentMethod->card->brand }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="card-last-4">**** **** **** {{ $defaultPaymentMethod->card->last4 }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <span class="card-expiration">{{ $defaultPaymentMethod->card->exp_month }}/{{ $defaultPaymentMethod->card->exp_year }}</span>
                                                </div>
                                                <div class="col-3">
                                                    <p>Default payment method</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @foreach ($paymentMethods as $paymentMethod)
                                        @if (!$defaultPaymentMethod || $defaultPaymentMethod->id !== $paymentMethod->id)
                                            <li class="list-group-item">
                                                <div class="row payment-card">
                                                    <div class="col-3">
                                                        <span class="card-brand">{{ $paymentMethod->card->brand }}</span>
                                                    </div>
                                                    <div class="col-3">
                                                        <span class="card-last-4">**** **** **** {{ $paymentMethod->card->last4 }}</span>
                                                    </div>
                                                    <div class="col-3">
                                                        <span class="card-expiration">{{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</span>
                                                    </div>
                                                    <div class="col-3 actions">
                                                        <form method="POST" action="{{route('set_default_card')}}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $paymentMethod->id }}">
                                                            <button class="remove-card btn btn-success" title="Set as sdefault card">
                                                                <i class="las la-star"></i>
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{route('remove_card')}}">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $paymentMethod->id }}">
                                                            <button class="remove-card btn btn-danger" title="Remove card">
                                                                <i class="las la-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <p>You have no payment methods saved</p>
                            @endif
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">Subscriptions</h4>
                        </div>
                        <div class="card-body">
                            @if (count($subscriptions) > 0)
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row payment-card">
                                            <div class="col-3">PLAN</div>
                                            <div class="col-6">STATUS</div>
                                            <div class="col-3">ACTIONS</div>
                                        </div>
                                    </li>
                                    @foreach ($subscriptions as $subscription)
                                        <li class="list-group-item">
                                            <div class="row payment-card">
                                                <div class="col-3">
                                                    <span>{{ $subscription->name }}</span>
                                                </div>
                                                <div class="col-6">
                                                    @if(($subscription->stripe_status === 'active' || $subscription->stripe_status === 'trialing') && !!$subscription->ends_at)
                                                        <span>Grace period ends at: {{ $subscription->ends_at->format('m/d/Y') }}</span>
                                                    @elseif($subscription->stripe_status === 'trialing' && !$subscription->ends_at)
                                                        <span>Trial. Ends at: {{ $subscription->trial_ends_at->format('m/d/Y') }}</span>
                                                    @else
                                                        <span>{{ $subscription->stripe_status }}</span>
                                                    @endIf
                                                </div>
                                                <div class="col-3 actions">
                                                    @if(($subscription->stripe_status === 'active' || $subscription->stripe_status === 'trialing') && !!$subscription->ends_at)
                                                    <form method="POST" action="{{route('resume')}}">
                                                        @csrf
                                                        <button class="remove-card btn btn-primary" title="Renew subscription">
                                                            <i class="las la-redo-alt"></i>
                                                        </button>
                                                    </form>
                                                    @endIf
                                                    @if(
                                                        $subscription->stripe_status !== 'canceled' &&
                                                        (($subscription->stripe_status === 'active' || $subscription->stripe_status === 'trialing') && !$subscription->ends_at)
                                                    )
                                                        <form method="POST" action="{{route('unsubscribe')}}">
                                                            @csrf
                                                            <button class="remove-card btn btn-danger" title="Cancel subscription">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </form>
                                                    @endIf
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                @if ($defaultPaymentMethod)
                                    <p>You have no active subscription</p>
                                    <h2 class="text-center">Subscribe now!</h2>
                                    <div class="plans">
                                        @foreach($plans as $plan)
                                            <div class="card plan">
                                                <form method="POST" action="{{route('subscribe')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $plan->id }}">
                                                    <h3 class="text-center">Premium plan</h3>
                                                    <ul>
                                                        <li>- ${{ number_format($plan->unit_amount / 100, 0) }}</li>
                                                        <li>- {{ $plan->recurring->trial_period_days }} days of trial (first time subscribers)</li>
                                                        <li>- Unlimited add posting</li>
                                                        <li>- display your adds on thousands of customers searches</li>
                                                    </ul>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>Add a payment method below and set it as default (click on the star!)</p>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">Add a new payment method</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-10 col-lg-8">
                                    <input id="stripe-pk" type="hidden" value="{{ env('STRIPE_KEY') }}">
                                    <input id="stripe-cs" type="hidden" value="{{ $intent->client_secret }}">
                                    <div class="form-group">
                                        <input id="card-holder-name" type="text" class="form-control" placeholder="Card holder name">
                                    </div>
                                    <div class="form-group">
                                        <div id="card-element"></div>
                                    </div>

                                    <div class="form-group submit-group">
                                        <button id="card-button" class="btn btn-primary">Add Payment Method</button>
                                        <span class="spinner">
                                            <i class="las la-2x la-spinner la-pulse"> </i>
                                        </span>
                                    </div>

                                    <form id="pm_form" method="POST" action="{{route('add_new_card')}}" style="display: none;">
                                        @csrf
                                        <input id="payment_method" name="payment_method" type="hidden">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .member-wrap -->
            </div>
        </div><!-- .site-content -->
    </main><!-- .site-main -->
@stop

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var strilePk       = document.getElementById('stripe-pk').value;
        var strileCs       = document.getElementById('stripe-cs').value;
        var stripe         = Stripe(strilePk);
        var cardHolderName = document.getElementById('card-holder-name');
        var cardInput      = document.getElementById('card-element');
        var cardButton     = document.getElementById('card-button');
        var elements       = stripe.elements();
        var cardElement    = elements.create('card');

        cardInput.classList.add('form-control');

        cardElement.mount('#card-element');

        cardButton.addEventListener('click', function() {
            Array.from(document.getElementsByTagName('button')).forEach(function(btn) { btn.disabled = true; });

            document.getElementsByClassName('spinner')[0].classList.add('show');

            stripe.confirmCardSetup(
                strileCs, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            ).catch(function(error) {
                console.log(error);
            })
            .then(function(response) {
                document.getElementById('payment_method').value = response.setupIntent.payment_method;

                document.getElementById('pm_form').submit();
            }).finaly(function() {
                Array.from(document.getElementsByTagName('button')).forEach(function(btn) { btn.disabled = false; });
            });
        });

        $('.plan').click(function() {
            $(this).find('form')[0].submit();
        })
    </script>
@endpush
<style>
    .spinner {
        display: none
    }
    .spinner.show {
        display: inline-block;
    }
    .actions {
        display: flex;
    }
    .actions button {
        margin-right: 10px;
    }
    .btn.btn-danger {
        background-color: #be2736;
    }
    .plans {
        margin: 30px 0 0;
        display: flex;
        justify-content: center;
    }
    .plan {
        cursor: pointer;
        padding: 20px;
    }
    .plan:hover {
        background: rgba(245,245,245)
    }
    .plan ul {
        list-style: none;
    }
</style>
