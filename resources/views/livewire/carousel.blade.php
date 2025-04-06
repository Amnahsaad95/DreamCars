	<!-- ✅ Carousel احترافي بكامل عرض الصفحة -->
	<section class="relative w-full h-[500px] md:h-[600px] lg:h-[700px] overflow-hidden">
		<div class="relative w-full h-full" x-data="{ current: 0, slides: ['{{ asset('Carousel/Car1.jpg') }}', '{{ asset('Carousel/Car2.jpg') }}', '{{ asset('Carousel/Car3.jpg') }}'] }" x-init="setInterval(() => current = (current + 1) % slides.length, 5000)">
			
			<!-- ✅ الصور -->
			<template x-for="(slide, index) in slides" :key="index">
				<div x-show="current === index" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700" :style="'background-image: url(' + slide + ')'"></div>
			</template>

			<!-- ✅ النصوص بأسلوب أنيق -->
			<div class="absolute top-1/2 right-10 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-6 rounded-md shadow-lg">
				<h2 class="text-4xl font-bold">اكتشف أفضل العروض</h2>
				<p class="text-lg mt-3">ابحث عن سيارتك المثالية اليوم</p>
				<a href="#" class="mt-4 inline-block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">ابحث الآن</a>
			</div>

			<!-- ✅ أزرار التنقل -->
			<button @click="current = (current - 1 + slides.length) % slides.length" class="absolute left-5 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-4 rounded-full shadow-lg">‹</button>
			<button @click="current = (current + 1) % slides.length" class="absolute right-5 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-4 rounded-full shadow-lg">›</button>

		</div>
	</section>
