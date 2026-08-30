<section>
    <header>
        <h2 class="text-xl font-bold text-primary-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            Perbarui informasi profil dasar Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>



        <div>
            <x-input-label for="phone" :value="__('Nomor Telepon')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '')" />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
        </div>

        @if($user->role === 'peserta')
            <div>
                <x-input-label for="grade" :value="__('Kelas')" />
                <x-text-input id="grade" name="grade" type="text" class="mt-1 block w-full" :value="old('grade', $user->grade)" />
                <x-input-error class="mt-2" :messages="$errors->get('grade')" />
            </div>

            <div>
                <x-input-label for="institution" :value="__('Instansi (Asal Sekolah)')" />
                <x-text-input id="institution" name="institution" type="text" class="mt-1 block w-full bg-slate-50 cursor-not-allowed text-slate-500" :value="$user->institution ? $user->institution->name : 'Belum Terdaftar di Instansi'" readonly disabled />
                <p class="mt-1 text-xs text-slate-500">Instansi tidak dapat diubah secara mandiri. Silakan hubungi admin.</p>
            </div>
        @endif

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button>Simpan Perubahan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>
