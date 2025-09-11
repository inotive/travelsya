@extends('ekstranet.layout', [
    'title' => 'Beranda',
    'url' => '#',
    'subTitle' => 'Edit Data',
])

@section('content-admin')
<div class="card">
    <div class="card-body">
        <form action="{{ route('partner.update.bus-travel', $bus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Bisnis Bus & Travel</label>
                    <select class="form-control" id="bus_travel_id" name="bus_travel_id">
                        <option value="">Pilih Bisnis Bus & Travel</option>
                        @foreach($bus_travel as $bt)
                            <option value="{{ $bt->id }}" {{ old('bus_travel_id', $bus->bus_travel_id) == $bt->id ? 'selected' : '' }}>
                                {{ $bt->business_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('bus_travel_id') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Nama</label>
                    <input type="text" class="form-control form-control-lg" name="name"
                        value="{{ old('name', $bus->name) }}" placeholder="Masukkan Nama" />
                    @error('name') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Kelas</label>
                    <input class="form-control form-control-lg" name="class"
                        value="{{ old('class', $bus->class) }}" placeholder="Masukkan Kelas" />
                    @error('class') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <select class="form-control" name="is_active">
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('is_active', $bus->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $bus->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('is_active') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                    <input type="number" class="form-control form-control-lg" name="number_seats"
                        value="{{ old('number_seats', $bus->number_seats) }}" placeholder="Masukkan Jumlah Kursi" />
                    @error('number_seats') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Existing Images Section --}}
            @if($bus->image)
                <div class="col-md-12 mt-4">
                    <label class="fs-6 fw-semibold mb-2">Gambar Yang Sudah Ada</label>
                    <div class="d-flex flex-wrap gap-3" id="existing-images-container">
                        @foreach(json_decode($bus->image, true) ?? [] as $index => $img)
                            <div class="existing-image-card" data-image="{{ $img }}">
                                <div class="image-wrapper">
                                    <img src="{{ asset('storage/buses/'.$img) }}" class="existing-image" alt="Bus Image">
                                    <button type="button" class="btn-remove-existing" onclick="removeExistingImage('{{ $img }}', this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Hidden input to track removed images --}}
                    <input type="hidden" name="removed_images" id="removed-images" value="">
                </div>
            @endif

            {{-- Multiple Upload Section --}}
            <div class="form-row mt-4">
                <div class="form-group">
                    <label class="fs-6 fw-semibold mb-2">Upload Gambar Baru</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                    @error('images.*') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                    <div id="image-preview-container" class="d-flex flex-wrap gap-3 mt-3"></div>
                </div>
            </div>

            <div class="form-group mt-4">
                <label class="fs-6 fw-semibold mb-2">Fasilitas Bus</label>
                <div class="row">
                    @foreach ($facilities as $facility)
                        <div class="col-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="facilities[]"
                                    value="{{ $facility->id }}" id="facility{{ $facility->id }}"
                                    {{ in_array($facility->id, old('facilities', $selectedFacilities)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="facility{{ $facility->id }}">
                                    {{ $facility->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('facilities') <span class="text-danger mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="required fs-6 fw-semibold mb-2">Peraturan atau Ketentuan</label>
                <textarea class="form-control" name="tos" required>{{ old('tos', $bus->tos) }}</textarea>
                @error('tos') <span class="text-danger mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="row mt-5">
                <div class="col">
                    <input class="btn btn-secondary" id="backButton" onclick="window.history.go(-1); return false;" type="submit" value="Kembali" />
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('add-script')
<script>
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');
    let removedImages = [];
    let fileArray = []; // Use a simple array as the source of truth

    // --- Event Listener ---
    imageInput.addEventListener('change', (e) => {
        // Add newly selected files to our array
        for (const file of e.target.files) {
            fileArray.push(file);
        }
        // Sync the file input with our array and render previews
        syncInputAndRender();
    });

    // --- Functions ---

    function removeFile(index) {
        // Remove the file from our array at the given index
        fileArray.splice(index, 1);
        // Re-sync and re-render
        syncInputAndRender();
    }

    function syncInputAndRender() {
        // Create a new DataTransfer object
        const dataTransfer = new DataTransfer();
        // Add all files from our array to the DataTransfer object
        for (const file of fileArray) {
            dataTransfer.items.add(file);
        }
        // Update the real file input's files list
        imageInput.files = dataTransfer.files;
        // Render the previews based on our array
        renderPreviews();
    }

    function renderPreviews() {
        // Clear the preview container
        previewContainer.innerHTML = '';
        
        // Render a preview for each file in our array
        fileArray.forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewCard = document.createElement('div');
                previewCard.className = 'preview-image-card';

                const imageWrapper = document.createElement('div');
                imageWrapper.className = 'image-wrapper';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-image';

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn-remove-preview';
                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                removeBtn.type = 'button';
                removeBtn.addEventListener('click', (event) => {
                    event.preventDefault();
                    removeFile(i); // Call removeFile with the correct index
                });

                imageWrapper.appendChild(img);
                imageWrapper.appendChild(removeBtn);
                previewCard.appendChild(imageWrapper);
                previewContainer.appendChild(previewCard);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeExistingImage(imageName, button) {
        if (!removedImages.includes(imageName)) {
            removedImages.push(imageName);
            document.getElementById('removed-images').value = JSON.stringify(removedImages);
        }

        const imageCard = button.closest('.existing-image-card');
        imageCard.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
            imageCard.remove();
        }, 300);
    }
</script>
@endpush

<style>
    .active {
        background: #007bff;
        color: white;
    }

    .breadcrumb {
        margin-bottom: 20px;
    }

    .form-container {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
    }

    .form-row {
        display: flex;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        margin-right: 15px;
    }

    .form-group:last-child {
        margin-right: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select,
    input,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 100px;
    }

    .button-group {
        text-align: right;
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        margin-left: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .primary {
        background: #007bff;
        color: white;
    }

    /* Existing Image Card Styles */
    .existing-image-card, .preview-image-card {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }

    .existing-image-card:hover, .preview-image-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .existing-image, .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .existing-image-card:hover .existing-image,
    .preview-image-card:hover .preview-image {
        transform: scale(1.05);
    }

    .btn-remove-existing, .btn-remove-preview {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.95);
        color: #dc3545;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        opacity: 0;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(4px);
    }

    .existing-image-card:hover .btn-remove-existing,
    .preview-image-card:hover .btn-remove-preview {
        opacity: 1;
    }

    .btn-remove-existing:hover, .btn-remove-preview:hover {
        background: rgba(255, 255, 255, 1);
        color: #dc3545;
        transform: scale(1.15);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-remove-existing i, .btn-remove-preview i {
        font-size: 16px;
        font-weight: 600;
    }

    /* Fade out animation for removed images */
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }

    /* Add some spacing and responsiveness */
    @media (max-width: 768px) {
        .existing-image-card, .preview-image-card {
            width: 100px;
            height: 100px;
        }
    }

    /* Optional: Add a subtle border to distinguish existing vs new images */
    .existing-image-card {
        border-color: #28a745;
    }

    .preview-image-card {
        border-color: #007bff;
    }
</style>
