<!-- 8. Customer Reviews -->
    <div class="container mx-auto px-4 py-8 bg-gray-100 rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">{{ __('messages.CustomerReviews') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		@foreach($reviews as $review)
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex items-center mb-4">
                        
                        <div class="ml-4">
                            <h4 class="font-semibold" >{{ $review->name}}</h4>
                            <div class="flex text-amber-400">
                                <p>{{$review->user->name ?? ''}} {{$review->car->Brand ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600" >{{$review->content}}</p>
                </div>
		@endforeach
        </div>
    </div>