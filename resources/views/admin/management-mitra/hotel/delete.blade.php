
<script>
    $('body').on('click', '#tombol-delete', function() {

        let hotel_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: 'error',
            showCancelButton: true,
            cancelButtonText: 'Kembali',
            confirmButtonText: 'Ya, Hapus!',
            customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: 'btn btn-secondary text-white'
        }
        }).then((result) => {
            if (result.isConfirmed) {

                console.log('test');

                $.ajax({
                    url: `/admin/management-mitra/hotel/${hotel_id}`,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success:function(response){

                        //remove post on table
                        $(`#index_${hotel_id}`).remove();
                                location.reload();
                    }
                });
            }
        });
    });
</script>
