<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
 <!-- Dashboard Content -->
 <div class="max-w-6xl mx-auto p-4" 
     x-data="{
         initCharts() {
             // Brand Chart (Bar)
             new Chart(
                 this.$refs.brandChart,
                 {
                     type: 'bar',
                     data: {
                         labels: @js($brandChart['labels']),
                         datasets: [{
                             label: 'Number of Cars',
                             data: @js($brandChart['data']),
                             backgroundColor: '#3B82F6',
                             borderRadius: 4
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         scales: {
                             y: {
                                 beginAtZero: true
                             }
                         }
                     }
                 }
             );
             
             // Price Chart (Line)
             new Chart(
                 this.$refs.priceChart,
                 {
                     type: 'line',
                     data: {
                         labels: @js($priceChart['labels']),
                         datasets: [{
                             label: 'Average Price ($)',
                             data: @js($priceChart['data']),
                             borderColor: '#10B981',
                             backgroundColor: 'rgba(16, 185, 129, 0.1)',
                             fill: true,
                             tension: 0.3
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false
                     }
                 }
             );
             
             // Status Chart (Pie)
             new Chart(
                 this.$refs.statusChart,
                 {
                     type: 'pie',
                     data: {
                         labels: @js($statusChart['labels']),
                         datasets: [{
                             data: @js($statusChart['data']),
                             backgroundColor: @js($statusChart['colors']),
                             borderWidth: 1
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         plugins: {
                             legend: {
                                 position: 'right'
                             }
                         }
                     }
                 }
             );
             
             // Country Chart (Donut)
             new Chart(
                 this.$refs.countryChart,
                 {
                     type: 'doughnut',
                     data: {
                         labels: @js($countryChart['labels']),
                         datasets: [{
                             data: @js($countryChart['data']),
                             backgroundColor: @js($countryChart['colors']),
                             borderWidth: 1
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         cutout: '70%',
                         plugins: {
                             legend: {
                                 position: 'right'
                             }
                         }
                     }
                 }
             );
         }
     }"
     x-init="
         // Initial render
         initCharts();
         
         // Update charts when Livewire updates
         $watch('$wire.stats', () => {
             setTimeout(() => initCharts(), 100);
         })
     ">
    
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('dashboard.car_data_analytics') }}</h1>
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('dashboard.total_cars') }}</p>
                                <p class="text-2xl font-bold">{{$cars}}</p>
                            </div>
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <i class="fas fa-car-alt text-indigo-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('dashboard.total_users') }}</p>
                                <p class="text-2xl font-bold">{{$users}}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-users text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('dashboard.total_ads') }}</p>
                                <p class="text-2xl font-bold">{{$ads}}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-ad text-green-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('dashboard.avg_price') }}</p>
                                <p class="text-2xl font-bold">{{$stats['avgPrice']}}</p>
                            </div>
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <i class="fas fa-car-alt text-indigo-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('dashboard.available') }}</p>
                                <p class="text-2xl font-bold">{{$stats['availableCount']}}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
								<i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">{{ __('dashboard.sold') }}</p>
                                <p class="text-2xl font-bold">{{$stats['soldCount']}}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
								<i class="fas fa-times-circle text-red-600 text-xl mr-1"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

    <!-- Chart Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Cars by Brand (Bar Chart) -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">{{ __('dashboard.cars_by_brand') }}</h2>
            <div class="h-64">
                <canvas x-ref="brandChart"></canvas>
            </div>
        </div>
        
        <!-- Price Trends (Line Chart) -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">{{ __('dashboard.price_by_year') }}</h2>
            <div class="h-64">
                <canvas x-ref="priceChart"></canvas>
            </div>
        </div>
        
        <!-- Sold vs Unsold (Pie Chart) -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">{{ __('dashboard.sales_status') }}</h2>
            <div class="h-64">
                <canvas x-ref="statusChart"></canvas>
            </div>
        </div>
        
        <!-- Cars by Country (Donut Chart) -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">{{ __('dashboard.cars_by_country') }}</h2>
            <div class="h-64">
                <canvas x-ref="countryChart"></canvas>
            </div>
        </div>
    </div>
</div>
</div>