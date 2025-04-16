<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('auth.user_manag') }}</h1>
    
    <!-- Search and Add New Car Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="relative w-full md:w-64">
            <input type="text" wire:model.live.debounce.150ms="search" placeholder="{{ __('auth.search_user') }}" 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
		
    </div>
    
    <!-- Sorting Controls -->
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <div class="flex items-center gap-2">
            <label for="sort-by" class="text-sm font-medium text-gray-700">{{ __('dashboard.sort_by') }}</label>
            <select wire:model.live="sortBy" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="name">{{ __('auth.name') }}</option>
                <option value="email">{{ __('auth.email') }}</option>
                <option value="created_at">{{ __('auth.date') }}</option>
            </select>
        </div>
        <div class="flex items-center gap-2">
            <label for="sort-order" class="text-sm font-medium text-gray-700">{{ __('dashboard.order') }}</label>
            <select wire:model.live="sortDirection" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="asc">{{ __('dashboard.asc') }}</option>
                <option value="desc">{{ __('dashboard.desc') }}</option>
            </select>
        </div>
    </div>
    
    <!-- Cars Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
						
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">
                            {{ __('auth.name') }}
                            @if($sortBy === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('email')">
                            {{ __('auth.email') }}
                            @if($sortBy === 'email')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('auth.phone') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('auth.City') }}</th>
                        
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('auth.Country') }}</th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
										@isset($user->profile_Image)
											<img src="{{ asset('storage/'.$user->profile_Image ) }}" alt="User Profile" class="h-10 w-10 rounded-full object-cover">
										@else
											<img src="{{ asset('storage/profile/default-profile.jpg' ) }}" alt="User Profile" class="h-10 w-10 rounded-full object-cover">
										@endisset
									</div>
                                </div>
                            </td>
							<td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->phone}}</div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->city }}</div>
                            </td>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->country }}</div>
                            </td>
							
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                               
                                <button wire:click="delete({{ $user->user_Id }})" wire:confirm="{{ __('messages.are_you_sure') }}" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                {{ __('auth.no_user') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-700">
            {{ __('dashboard.showing') }} <span class="font-medium">{{ $users->firstItem() }}</span> {{ __('dashboard.to') }} <span class="font-medium">{{ $users->lastItem() }}</span> {{ __('dashboard.of') }} <span class="font-medium">{{ $users->total() }}</span> {{ __('dashboard.results') }}
        </div>
        <div class="flex space-x-2">
            {{ $users->links() }}
        </div>
    </div>

	
   
</div>

