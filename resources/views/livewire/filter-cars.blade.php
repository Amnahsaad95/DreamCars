<div>

  <h1>
    Hello, World!
  </h1>
  
  <div x-data="filterSystem()" class="container mx-auto p-4">
    <!-- زر إظهار الفلاتر -->
    <button @click="showFilters = !showFilters" class="bg-blue-500 text-white px-4 py-2 rounded">
        Filter
    </button>

    <!-- صندوق الفلاتر -->
    <div x-show="showFilters" class="absolute   bg-white p-4 border rounded shadow-lg z-50 w-full md:w-1/2">
        <!-- زر إضافة فلتر -->
        <button @click="addFilter()" class="bg-green-500 text-white px-4 py-2 rounded">
            + إضافة فلتر
        </button>

        <!-- قائمة الفلاتر المختارة -->
        <div class="mt-4 space-y-2">
            <template x-for="(filter, index) in filters" :key="index">
                <div class="p-2 border rounded">
                    <!-- نوع الفلتر -->
                    <select x-model="filter.type" @change="setFilterFields(index)" class="p-2 border rounded">
                        <option value="">اختر فلتر</option>
                        <option value="brand">العلامة التجارية</option>
                        <option value="price">السعر</option>
                        <option value="availability">التوفر</option>
                    </select>

                    <!-- حقول الإدخال حسب الفلتر -->
                    <div x-show="filter.type === 'brand'" class="mt-2">
                        <input x-model="filter.value" type="text" placeholder="أدخل العلامة التجارية" class="p-2 border rounded w-full">
                    </div>
                    <div x-show="filter.type === 'price'" class="mt-2">
                        <select x-model="filter.value" class="p-2 border rounded w-full">
                            <option value="">اختر السعر</option>
                            <option value="low">أقل من 20,000$</option>
                            <option value="mid">20,000$ - 50,000$</option>
                            <option value="high">أكثر من 50,000$</option>
                        </select>
                    </div>
                    <div x-show="filter.type === 'availability'" class="mt-2">
                        <select x-model="filter.value" class="p-2 border rounded w-full">
                            <option value="">اختر الحالة</option>
                            <option value="available">متوفر</option>
                            <option value="sold">تم بيعه</option>
                        </select>
                    </div>

                    <!-- زر إزالة الفلتر -->
                    <button @click="removeFilter(index)" class="bg-red-500 text-white px-2 py-1 mt-2 rounded">
                        حذف الفلتر
                    </button>
                </div>
            </template>
        </div>

        <!-- زر تطبيق الفلاتر -->
        <button @click="applyFilters()" class="bg-blue-600 text-white px-4 py-2 mt-4 rounded">
            تطبيق الفلاتر
        </button>
    </div>

    <!-- ✅ قائمة المنتجات -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <template x-for="car in filteredCars()" :key="car.id">
            <div class="p-4 border rounded">
                <h2 class="text-lg font-bold" x-text="car.name"></h2>
                <p>السعر: <span x-text="car.price"></span>$</p>
                <p>الحالة: <span x-text="car.availability"></span></p>
            </div>
        </template>
    </div>
</div>
  <script>
  document.addEventListener("alpine:init", () => {
    Alpine.data("filterSystem", () => ({
        showFilters: false,
        filters: [],
        selectedFilters: [],
        cars: [
            { id: 1, name: "Toyota Corolla", brand: "Toyota", price: "mid", availability: "available" },
            { id: 2, name: "BMW X5", brand: "BMW", price: "high", availability: "sold" },
            { id: 3, name: "Honda Civic", brand: "Honda", price: "low", availability: "available" }
        ],

        addFilter() {
            this.filters.push({ type: "", value: "" });
        },

        removeFilter(index) {
            this.filters.splice(index, 1);
        },

        applyFilters() {
            this.selectedFilters = this.filters.filter(f => f.type && f.value);
        },

        filteredCars() {
            if (this.selectedFilters.length === 0) return this.cars;
            return this.cars.filter(car => 
                this.selectedFilters.every(filter => {
                    if (filter.type === "brand") return car.brand === filter.value;
                    if (filter.type === "price") return car.price === filter.value;
                    if (filter.type === "availability") return car.availability === filter.value;
                    return true;
                })
            );
        }
    }));
});
  </script>
</div>