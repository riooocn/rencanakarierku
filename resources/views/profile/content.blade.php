<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
    <div class="p-6 sm:p-10">
        <div class="max-w-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>
</div>

@if(auth()->user()->password)
<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
    <div class="p-6 sm:p-10">
        <div class="max-w-2xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>
@endif


