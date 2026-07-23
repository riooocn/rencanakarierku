@if (session('success') || session('status'))
    @php
        $toastType = session('success') ? 'success' : 'info';
        $toastMessage = session('success') ?? session('status');
    @endphp
    <!-- Tailwind Toast Notification -->
    <div id="tailwindToast" class="fixed bottom-6 right-6 z-[100] flex items-center w-full max-w-sm p-4 space-x-3 text-slate-700 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 transform translate-y-10 opacity-0 transition-all duration-300" role="alert">
        @if($toastType === 'success')
            <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-emerald-500 bg-emerald-50 rounded-full">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        @else
            <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-blue-500 bg-blue-50 rounded-full">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        @endif
        <div class="ms-3 text-sm font-medium">
            {{ $toastMessage }}
        </div>
        <button type="button" onclick="closeToast()" class="ms-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-slate-900 rounded-lg focus:ring-2 focus:ring-slate-300 p-1.5 hover:bg-slate-100 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
            <span class="sr-only">Tutup</span>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toast = document.getElementById('tailwindToast');
            if (toast) {
                // Slide in animation
                setTimeout(() => {
                    toast.classList.remove('translate-y-10', 'opacity-0');
                    toast.classList.add('translate-y-0', 'opacity-100');
                }, 100);

                // Auto close after 2.5s (faster and less intrusive)
                setTimeout(() => {
                    closeToast();
                }, 2500);
            }
        });

        function closeToast() {
            const toast = document.getElementById('tailwindToast');
            if (toast) {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 300);
            }
        }
    </script>
@endif

@if (session('error'))
<!-- Session Error Modal -->
<div id="sessionErrorModal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all translate-y-0 scale-100">
        <div class="flex items-center justify-center w-20 h-20 mx-auto bg-rose-50 rounded-full mb-6 ring-8 ring-rose-50/50">
            <svg class="w-10 h-10 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        
        <h3 class="text-xl font-extrabold text-center text-slate-900 mb-2 tracking-tight">Terjadi Kesalahan</h3>
        <p class="text-center text-slate-600 mb-8 text-sm leading-relaxed">{{ session('error') }}</p>
        
        <div class="flex flex-col gap-3">
            <button onclick="document.getElementById('sessionErrorModal').style.display='none';" class="w-full py-3.5 px-4 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl shadow-lg shadow-rose-500/30 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<!-- Validation Errors Modal -->
<div id="validationErrorModal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 transform transition-all translate-y-0 scale-100">
        <div class="flex items-center justify-center w-20 h-20 mx-auto bg-rose-50 rounded-full mb-6 ring-8 ring-rose-50/50">
            <svg class="w-10 h-10 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        
        <h3 class="text-xl font-extrabold text-center text-slate-900 mb-3 tracking-tight">Peringatan</h3>
        
        <div class="text-slate-600 mb-8 text-sm leading-relaxed text-center">
            <ul class="inline-block text-left list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        
        <div class="flex flex-col gap-3">
            <button onclick="document.getElementById('validationErrorModal').style.display='none';" class="w-full py-3.5 px-4 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl shadow-lg shadow-rose-500/30 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
@endif
