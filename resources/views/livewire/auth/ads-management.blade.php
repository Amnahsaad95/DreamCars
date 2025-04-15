<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('dashboard.ads_management') }}</h1>
    
    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    <!-- Search Bar -->
    <div class="mb-4">
        <div class="relative">
            <input 
                type="text" 
                wire:model.live.debounce.150ms="search"
                placeholder="Search adss..." 
                class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-1/3"
            >
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>
    <!-- Tabs Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <ul class="flex flex-wrap -mb-px">
			<li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('all')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-check-circle mr-2 text-published"></i>
                    {{ __('dashboard.all') }} 
					<span class="ml-2 bg-published text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$all->total()}}</span>
                </button>
            </li>
			
            <li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('pending')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'pending' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-clock mr-2 text-secondary"></i>
                    {{ __('dashboard.new') }}
					<span class="ml-2 bg-secondary text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$pendingAds->total()}}</span>				
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('published')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'published' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-share-square mr-2 text-published"></i>
                     {{ __('dashboard.published') }} 
					<span class="ml-2 bg-published text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$publishedAds->total()}}</span>
                </button>
            </li>
			<li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('unpublished')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'unpublished' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-box-archive mr-2 text-primary"></i>
                     {{ __('dashboard.unpublished') }} 
					<span class="ml-2 bg-primary text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$unpublishedAds->total()}}</span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('rejected')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'rejected' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-ban mr-2 text-rejected"></i>
                     {{ __('dashboard.rejected') }} 
					<span class="ml-2 bg-rejected text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$rejectedAds->total()}}</span>
                </button>
            </li>
        </ul>
    </div>
    
    
    <!-- All adss Tab -->
    <div class="{{ $activeTab !== 'all' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ __('dashboard.all_ads') }} </h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.FullName') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.hit') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.url') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.location') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.status') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.start_date') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.end_date') }}</th>
                        <th scope="col" class="px-6 py-3 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all as $ads)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
								<div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										<img src="{{ asset('storage/'.$ads->Image ) }}" alt="Ads Image" class="h-10 w-10 rounded-full object-cover">
									</div>
								</div>
							</td>
                            <td class="px-6 py-4">{{ $ads->FullName }}</td>
                            <td class="px-6 py-4">{{ $ads->hit }}</td>
                            <td class="px-6 py-4">{{ $ads->ad_Url }}</td>
                            <td class="px-6 py-4">{{ $ads->location }}</td>
                            <td class="px-6 py-4">
							@if($ads->status == 'published' )
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.published') }}</span>
							@endif
							@if($ads->status == 'rejected' )
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.rejected') }}</span>
							@endif
							@if($ads->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.pending') }}</span>
							@endif
							@if( $ads->status == 'unpublished')
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.unpublished') }}</span>
							@endif
                            </td>
							
                            <td class="px-6 py-4">{{ $ads->start_date }}</td>
							
                            <td class="px-6 py-4">{{ $ads->End_date}}</td>
                            <td class="px-6 py-4 text-left">
                                @if($ads->status == 'published' )
									<button wire:click="unpublishAds({{ $ads->id }})" class="text-purple-600 hover:text-purple-900 mr-3">
										<i class="fas fa-eye-slash"></i>
									</button>
								@endif
								@if($ads->status == 'rejected' )
									<button wire:click="publishAds({{ $ads->id }})" class="text-purple-600 hover:text-purple-900 mr-3">
										<i class="fas fa-redo"></i>
									</button>
								@endif
								@if($ads->status == 'pending')
									<button wire:click="publishAds({{ $ads->id }})" class="text-green-600 hover:text-green-900 mr-3">
										<i class="fas fa-check"></i>
									</button>
									<button wire:click="rejectAds({{ $ads->id }})" class="text-red-600 hover:text-red-900 mr-3">
										<i class="fas fa-times"></i>
									</button>
								@endif
                                <button wire:click="deleteads({{ $ads->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">{{ __('dashboard.no_ads') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $all->links() }}
        </div>
    </div>
    <!-- Published adss Tab -->
    <div class="{{ $activeTab !== 'published' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ __('dashboard.published_ads') }}</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.FullName') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.hit') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.url') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.location') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.status') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.start_date') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.end_date') }}</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publishedAds as $ads)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
								<div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										<img src="{{ asset('storage/'.$ads->Image ) }}" alt="Ads Image" class="h-10 w-10 rounded-full object-cover">
									</div>
								</div>
							</td>
                            <td class="px-6 py-4">{{ $ads->FullName }}</td>
                            <td class="px-6 py-4">{{ $ads->hit }}</td>
                            <td class="px-6 py-4">{{ $ads->ad_Url }}</td>
                            <td class="px-6 py-4">{{ $ads->location }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.published') }}</span>
                            </td>
							<td class="px-6 py-4">{{ $ads->start_date }}</td>
							
                            <td class="px-6 py-4">{{ $ads->End_date}}</td>
                            <td class="px-6 py-4 text-left">
                                <button wire:click="unpublishAds({{ $ads->id }})" class="text-purple-600 hover:text-purple-900 mr-3">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                                <button wire:click="deleteAds({{ $ads->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">{{ __('dashboard.no_published_ads') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $publishedAds->links() }}
        </div>
    </div>
	<!-- Published adss Tab -->
    <div class="{{ $activeTab !== 'unpublished' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ __('dashboard.unpublished_ads') }}</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.FullName') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.hit') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.url') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.location') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.status') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.start_date') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.end_date') }}</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($unpublishedAds as $ads)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
								<div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										<img src="{{ asset('storage/'.$ads->Image ) }}" alt="Ads Image" class="h-10 w-10 rounded-full object-cover">
									</div>
								</div>
							</td>
                            <td class="px-6 py-4">{{ $ads->FullName }}</td>
                            <td class="px-6 py-4">{{ $ads->hit }}</td>
                            <td class="px-6 py-4">{{ $ads->ad_Url }}</td>
                            <td class="px-6 py-4">{{ $ads->location }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.unpublished') }}</span>
                            </td>
							<td class="px-6 py-4">{{ $ads->start_date }}</td>
							
                            <td class="px-6 py-4">{{ $ads->End_date}}</td>
                            <td class="px-6 py-4 text-left">
                                
                                <button wire:click="deleteAds({{ $ads->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">{{ __('dashboard.no_unpublished_ads') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $unpublishedAds->links() }}
        </div>
    </div>
    
    <!-- Rejected adss Tab -->
    <div class="{{ $activeTab !== 'rejected' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ __('dashboard.rejected_ads') }}</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.FullName') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.hit') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.url') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.location') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.status') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.start_date') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.end_date') }}</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rejectedAds as $ads)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
								<div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										<img src="{{ asset('storage/'.$ads->Image ) }}" alt="Ads Image" class="h-10 w-10 rounded-full object-cover">
									</div>
								</div>
							</td>
                            <td class="px-6 py-4">{{ $ads->FullName }}</td>
                            <td class="px-6 py-4">{{ $ads->hit }}</td>
                            <td class="px-6 py-4">{{ $ads->ad_Url }}</td>
                            <td class="px-6 py-4">{{ $ads->location }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.rejected') }}</span>
                            </td>
							<td class="px-6 py-4">{{ $ads->start_date }}</td>
							
                            <td class="px-6 py-4">{{ $ads->End_date}}</td>
                            <td class="px-6 py-4 text-left">
                                
                                <button wire:click="publishAds({{ $ads->id }})" class="text-purple-600 hover:text-purple-900 mr-3">
                                    <i class="fas fa-redo"></i>
                                </button>
                                <button wire:click="deleteAds({{ $ads->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">{{ __('dashboard.no_rejected_ads') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $rejectedAds->links() }}
        </div>
    </div>
    
    <!-- Pending adss Tab -->
    <div class="{{ $activeTab !== 'pending' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ __('dashboard.new_ads') }}</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.FullName') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.hit') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.url') }} </th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.location') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.status') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.start_date') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('dashboard.end_date') }}</th>
                        <th scope="col" class="px-6 py-3 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingAds as $ads)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
								<div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										<img src="{{ asset('storage/'.$ads->Image ) }}" alt="Ads Image" class="h-10 w-10 rounded-full object-cover">
									</div>
								</div>
							</td>
                            <td class="px-6 py-4">{{ $ads->FullName }}</td>
                            <td class="px-6 py-4">{{ $ads->hit }}</td>
                            <td class="px-6 py-4">{{ $ads->ad_Url }}</td>
                            <td class="px-6 py-4">{{ $ads->location }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ __('dashboard.pending') }}</span>
                            </td>
							<td class="px-6 py-4">{{ $ads->start_date }}</td>
							
                            <td class="px-6 py-4">{{ $ads->End_date}}</td>
                            <td class="px-6 py-4 text-left">
                                
                                <button wire:click="publishAds({{ $ads->id }})" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button wire:click="rejectAds({{ $ads->id }})" class="text-red-600 hover:text-red-900 mr-3">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button wire:click="deleteAds({{ $ads->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">{{ __('dashboard.no_pending_ads') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $pendingAds->links() }}
        </div>
    </div>
</div>

