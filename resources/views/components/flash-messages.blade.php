<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: {!! json_encode(session('success')) !!}
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: {!! json_encode(session('error')) !!},
                confirmButtonColor: '#0E2F56'
            });
        @endif

        @if (session('status'))
            Toast.fire({
                icon: 'info',
                title: {!! json_encode(session('status')) !!}
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                html: `
                    <ul class="text-left list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#0E2F56'
            });
        @endif
    });
</script>
