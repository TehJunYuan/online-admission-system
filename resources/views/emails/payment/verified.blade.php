<div>
    <h2>{{ __('Payment Verified!') }}</h2>
    <p>{{ __('Dear Applicant,') }}</p>
    <p>{{ __('This letter acknowledges the receipt of your payment for the products supplied. We have received your application & registration fee.') }}</p>
    <p>{{ __('---------------------------------------------------------') }}</p>
    <p>{{ $data['name'] }}</p>
    <p>{{$data['ic']}}</p>
    <p>{{$data['tempCode']}}</p>
    <p>{{$data['status']}}</p>
</div>