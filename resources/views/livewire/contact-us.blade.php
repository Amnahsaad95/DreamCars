<div>
   
    <h2>تواصل معنا</h2>

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div>
            <label for="name">الاسم:</label>
            <input type="text" id="name" wire:model="name" required />
        </div>

        <div>
            <label for="email">البريد الإلكتروني:</label>
            <input type="email" id="email" wire:model="email" required />
        </div>

        <div>
            <label for="message">الرسالة:</label>
            <textarea id="message" wire:model="message" required></textarea>
        </div>

        <div>
            <button type="submit">إرسال</button>
        </div>
    </form>


</div>
