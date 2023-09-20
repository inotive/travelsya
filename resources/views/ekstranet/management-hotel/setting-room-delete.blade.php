<script>
    $('body').on('click', '#tombol-delete', function() {
        let room_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");
        // let hotel_id = <?php echo json_encode($hotel->id); ?>;

        Swal.fire({
            title: 'Hapus Room',
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
                    // url: `/partner/management-hotel/hotel/${hotel_id}/room/${room_id}`,
                    url: `/partner/management-hotel/setting-hotel-room/delete/${room_id}`,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success:function(response){
                        $(`#index_${room_id}`).remove();
                        location.reload();
                    }
                });
            }
        });
    });
</script>

