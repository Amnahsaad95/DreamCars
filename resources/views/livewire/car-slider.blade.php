<div>
<h2 class="mb-4 text-center">أحدث السيارات</h2>
<div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($cars as $car)
                <div class="swiper-slide">
                    <div class="card">
                        <img src="{{ asset('storage/' . $car->car_Image) }}" alt="{{ $car->car_Name }}" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $car->car_Name }}</h5>
                            <p class="card-text">الماركة: {{ $car->brand->brand_Name }}</p>
                            <p class="card-text">السعر: {{ number_format($car->car_Price, 2) }} $</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- أزرار التنقل -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- نقاط التمرير -->
        <div class="swiper-pagination"></div>
    </div>

    <div class="text-center mt-3">
        <a href="#" class="btn btn-primary">عرض جميع السيارات</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: { 1024: { slidesPerView: 3 }, 768: { slidesPerView: 2 }, 480: { slidesPerView: 1 } }
        });
    });
</script>
