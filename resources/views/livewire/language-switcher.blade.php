<div >
 
	<button  wire:click="changeLanguage('{{ $currentLocale === 'ar' ? 'en' : 'ar' }}')"  class="px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-100">
		<i class="fa-solid fa-globe"></i>
		<span  >{{ $currentLocale === 'ar' ? 'English' : 'العربية' }}</span>
	</button>
</div>
