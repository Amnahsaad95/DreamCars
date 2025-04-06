<div>
 <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Cars</p>
                                <p class="text-2xl font-bold">{{$cars}}</p>
                                <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.5% from last month</p>
                            </div>
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <i class="fas fa-car-alt text-indigo-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Users</p>
                                <p class="text-2xl font-bold">{{$users}}</p>
                                <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.2% from last month</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Ads</p>
                                <p class="text-2xl font-bold">{{$ads}}</p>
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-arrow-down mr-1"></i> 3.7% from last month</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-ad text-green-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Conversion Rate</p>
                                <p class="text-2xl font-bold">3.42%</p>
                                <p class="text-green-500 text-sm mt-1"><i class="fas fa-arrow-up mr-1"></i> 1.1% from last month</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-percentage text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
</div>