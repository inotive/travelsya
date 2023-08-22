<div class="mt-20 bg-white" x-data>
    <div class="container-xxl py-10">
        <div class="row">
            <h2 class="fw-bold mb-3 mt-4">Jelajahi Sudut Kota</h2>
            <p class="fs-4 mb-10 text-gray-700">Ada berbagai pilihan destinasi liburan dengan harga spesial lho, jangan
                sampai kelewatan</p>
        </div>
        <div class="row">
            <template x-for="data in $store.explorecity.data">
                <div class="col-6 col-md-3 pb-6">
                    <img x-bind:src="data.image" x-bind:alt="data.label" class="img-thumbnail w-100" />
                </div>
            </template>
        </div>
    </div>
</div>
