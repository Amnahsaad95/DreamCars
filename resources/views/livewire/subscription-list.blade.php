<div>
<div class="container my-5">
    <h2 class="text-center mb-4">Subscription Plans</h2>
    
    <div class="row justify-content-center">
        @foreach ($subscriptions as $subscription)
            <div class="col-md-4" wire:key="subscription-{{ $subscription['Id'] }}">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ $subscription['name'] }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${{ number_format($subscription['price'], 2) }}/month</h5>
                        <ul class="list-unstyled">
                            @foreach ($subscription['features'] as $feature)
                                <li>✅ {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Subscribe Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</div>