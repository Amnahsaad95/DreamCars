<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Complaint / Suggestion Management</h1>
    
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
                placeholder="Search complaints..." 
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
                    All 
					<span class="ml-2 bg-published text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$all->total()}}</span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('published')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'published' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-share-square mr-2 text-published"></i>
                    Published 
					<span class="ml-2 bg-published text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$publishedComplaints->total()}}</span>
                </button>
            </li>
			<li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('unpublished')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'unpublished' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-box-archive mr-2 text-published"></i>
                    Unpublished 
					<span class="ml-2 bg-published text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$unpublished->total()}}</span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('rejected')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'rejected' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-ban mr-2 text-rejected"></i>
                    Rejected 
					<span class="ml-2 bg-rejected text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$rejectedComplaints->total()}}</span>
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button 
                    wire:click="changeTab('pending')"
                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $activeTab === 'pending' ? 'border-blue-500 text-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}"
                ><i class="fas fa-clock mr-2 text-pending"></i>
                    Pending
					<span class="ml-2 bg-pending text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{$pendingComplaints->total()}}</span>				
                </button>
            </li>
        </ul>
    </div>
    
    
    <!-- All Complaints Tab -->
    <div class="{{ $activeTab !== 'all' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">All Complaints</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">content</th>
                        <th scope="col" class="px-6 py-3">is_public</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Car Name</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($all as $complaint)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $complaint->complainant_Id }}</td>
                            <td class="px-6 py-4">{{ $complaint->name }}</td>
                            <td class="px-6 py-4">{{ $complaint->phone_email }}</td>
                            <td class="px-6 py-4">{{ $complaint->content }}</td>
                            <td class="px-6 py-4">{{ $complaint->is_public }}</td>
                            <td class="px-6 py-4">
							@if($complaint->status == 'accepted' && $complaint->is_public )
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Published</span>
							@endif
							@if($complaint->status == 'rejected' && $complaint->is_public )
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Rejected</span>
							@endif
							@if($complaint->status == 'pending' && $complaint->is_public )
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pending</span>
							@endif
							@if( !$complaint->is_public )
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Unpublished</span>
							@endif
                            </td>
							
                            <td class="px-6 py-4">{{ $complaint->user->name ?? '-' }}</td>
							
                            <td class="px-6 py-4">{{ $complaint->car->Brand ?? ''}} {{$complaint->car->car_Model ?? '-'}}</td>
                            <td class="px-6 py-4">
                                
                                <button wire:click="deleteComplaint({{ $complaint->complainant_Id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No published complaints found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $publishedComplaints->links() }}
        </div>
    </div>
    <!-- Published Complaints Tab -->
    <div class="{{ $activeTab !== 'published' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Published Complaints</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">content</th>
                        <th scope="col" class="px-6 py-3">is_public</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Car Name</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publishedComplaints as $complaint)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $complaint->complainant_Id }}</td>
                            <td class="px-6 py-4">{{ $complaint->name }}</td>
                            <td class="px-6 py-4">{{ $complaint->phone_email }}</td>
                            <td class="px-6 py-4">{{ $complaint->content }}</td>
                            <td class="px-6 py-4">{{ $complaint->is_public }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Published</span>
                            </td>
							
                            <td class="px-6 py-4">{{ $complaint->user->name ?? '-' }}</td>
							
                            <td class="px-6 py-4">{{ $complaint->car->Brand ?? ''}} {{$complaint->car->car_Model ?? '-'}}</td>
                            <td class="px-6 py-4">
                                <button wire:click="unpublishComplaint({{ $complaint->complainant_Id }})" class="text-purple-600 hover:text-purple-900 mr-3">
                                    <i class="fas fa-eye-slash"></i>
                                </button>
                                <button wire:click="deleteComplaint({{ $complaint->complainant_Id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No published complaints found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $publishedComplaints->links() }}
        </div>
    </div>
	<!-- Published Complaints Tab -->
    <div class="{{ $activeTab !== 'unpublished' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Unpublished Complaints</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">content</th>
                        <th scope="col" class="px-6 py-3">is_public</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Car Name</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($unpublished as $complaint)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $complaint->complainant_Id }}</td>
                            <td class="px-6 py-4">{{ $complaint->name }}</td>
                            <td class="px-6 py-4">{{ $complaint->phone_email }}</td>
                            <td class="px-6 py-4">{{ $complaint->content }}</td>
                            <td class="px-6 py-4">{{ $complaint->is_public }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Unpublished</span>
                            </td>
							
                            <td class="px-6 py-4">{{ $complaint->user->name ?? '-' }}</td>
							
                            <td class="px-6 py-4">{{ $complaint->car->Brand ?? ''}} {{$complaint->car->car_Model ?? '-'}}</td>
                            <td class="px-6 py-4">
                                
                                <button wire:click="deleteComplaint({{ $complaint->complainant_Id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No Unpublished complaints found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $unpublished->links() }}
        </div>
    </div>
    
    <!-- Rejected Complaints Tab -->
    <div class="{{ $activeTab !== 'rejected' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Rejected Complaints</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">content</th>
                        <th scope="col" class="px-6 py-3">is_public</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Car Name</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rejectedComplaints as $complaint)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $complaint->complainant_Id }}</td>
                            <td class="px-6 py-4">{{ $complaint->name }}</td>
                            <td class="px-6 py-4">{{ $complaint->phone_email }}</td>
                            <td class="px-6 py-4">{{ $complaint->content }}</td>
                            <td class="px-6 py-4">{{ $complaint->is_public }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Rejected</span>
                            </td>
							<td class="px-6 py-4">{{ $complaint->user->name ?? '-' }}</td>
							
                            <td class="px-6 py-4">{{ $complaint->car->Brand ?? ''}} {{$complaint->car->car_Model?? '-'}}</td>
                            <td class="px-6 py-4">
                                
                                <button wire:click="publishComplaint({{ $complaint->complainant_Id }})" class="text-purple-600 hover:text-purple-900 mr-3">
                                    <i class="fas fa-redo"></i>
                                </button>
                                <button wire:click="deleteComplaint({{ $complaint->complainant_Id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">No rejected complaints found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $rejectedComplaints->links() }}
        </div>
    </div>
    
    <!-- Pending Complaints Tab -->
    <div class="{{ $activeTab !== 'pending' ? 'hidden' : '' }} p-4 rounded-lg bg-white">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Pending Complaints</h2>
        
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">content</th>
                        <th scope="col" class="px-6 py-3">is_public</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Car Name</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingComplaints as $complaint)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">#{{ $complaint->complainant_Id }}</td>
                            <td class="px-6 py-4">{{ $complaint->name }}</td>
                            <td class="px-6 py-4">{{ $complaint->phone_email }}</td>
                            <td class="px-6 py-4">{{ $complaint->content }}</td>
                            <td class="px-6 py-4">{{ $complaint->is_public }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pending</span>
                            </td>
							<td class="px-6 py-4">{{ $complaint->user->name ?? '-' }}</td>
							
                            <td class="px-6 py-4">{{ $complaint->car->Brand ?? '' }} {{$complaint->car->car_Model ?? '-'}}</td>
                            <td class="px-6 py-4">
                                
                                <button wire:click="publishComplaint({{ $complaint->complainant_Id }})" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button wire:click="rejectComplaint({{ $complaint->complainant_Id }})" class="text-red-600 hover:text-red-900 mr-3">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button wire:click="deleteComplaint({{ $complaint->complainant_Id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No pending complaints found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $pendingComplaints->links() }}
        </div>
    </div>
</div>

