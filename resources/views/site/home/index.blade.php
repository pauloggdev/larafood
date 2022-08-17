@extends('site.layouts.app')
@section('content')
<main>
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

        @foreach($plans as $plan)
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">{{$plan->name}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">R$ {{ number_format($plan->price, 2,',','.') }}<small class="text-muted fw-light">/mês</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        @foreach($plan->details as $detail)
                        <li>{{ $detail->name }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('plan.subscription', $plan->url) }}"  class="w-100 btn btn-lg btn-outline-primary">ASSINAR</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>


</main>
@endsection