<script>
const button = document.getElementById('kt_docs_sweetalert_basic');

button.addEventListener('click', async (e) => {
    e.preventDefault();

    const { isConfirmed } = await Swal.fire({
        title: 'Konfirmasi Logout',
        text: 'Apakah anda yakin ingin logout?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya, Logout!',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-danger',
        },
    });

    if (isConfirmed) {
        try {
            const response = await fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            });

            if (response.ok) {
                // Redirect atau lakukan tindakan lain setelah logout berhasil
                window.location.href = '/login';
            } else {
                console.error('Logout Gagal');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
});
</script>


{{-- <div class="modal fade" tabindex="-1" id="kt_modal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text fs-2 text-center fw-bold mt-5 mb-5">
                Konfirmasi Logout?
            </div>
            <div class="text-center mb-5">
            <img src="{{ asset('assets/media/svg/profile-account/question.svg') }}" alt="question-svg" style="width: 100px; height: 100px;">
            </div>
            <div class="text fs-6 text-center fw-medium mb-5">
                Yakin Ingin Logout Dari Akun?
            </div>
            <div class="d-flex justify-content-center mb-5">
            <a class="btn btn-primary" style="margin-right: 20px">
                Ya, Logout
            </a>
            <a class="btn btn-danger" data-bs-dismiss="modal">
                Batal
            </a>
            </div>
        </div>
    </div>
</div> --}}
