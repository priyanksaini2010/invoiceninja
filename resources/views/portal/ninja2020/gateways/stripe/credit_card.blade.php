@extends('portal.ninja2020.layout.payments', ['gateway_title' => 'Stripe (Credit card)', 'card_title' => 'Stripe (Credit card)'])

@section('gateway_head')
    <meta name="stripe-publishable-key" content="{{ $gateway->getPublishableKey() }}">
    <meta name="stripe-token" content="{{ $token }}">
    <meta name="stripe-secret" content="{{ $intent->client_secret }}">
@endsection

@section('gateway_content')
    <form action="{{ route('client.payments.response') }}" method="post" id="server-response">
        @csrf
        <input type="hidden" name="gateway_response">
        <input type="hidden" name="store_card">
        <input type="hidden" name="payment_hash" value="{{$payment_hash}}">

        <input type="hidden" name="company_gateway_id" value="{{ $gateway->getCompanyGatewayId() }}">
        <input type="hidden" name="payment_method_id" value="{{ $payment_method_id }}">
    </form>

    @component('portal.ninja2020.components.general.card-element', ['title' => ctrans('texts.payment_type')])
        {{ ctrans('texts.credit_card') }} (Stripe)
    @endcomponent

    @include('portal.ninja2020.gateways.stripe.includes.card_widget')
    @include('portal.ninja2020.gateways.includes.pay_now')
@endsection

@section('gateway_footer')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/clients/payments/stripe-credit-card.js') }}"></script>
@endsection