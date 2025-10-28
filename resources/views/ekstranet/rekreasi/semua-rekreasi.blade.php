@extends('ekstranet.layout', ['title' => 'Semua Rekreasi', 'url' => '#'])

@section('content-admin')
    <div class="container">
        <div class="row">
            @foreach ($recreations as $recreation)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $recreation->business_name }}</h5>
                            <p class="card-text">{{ $recreation->city->city_name ?? '' }}</p>
                            <p class="card-text">{{ $recreation->address }}</p>
                            <p class="card-text">Rating: {{ $recreation->rating ?? 'N/A' }}</p>
                            <a href="{{ route('partner.recreation.profile', $recreation->id) }}" class="btn btn-primary">Profil Rekreasi</a>
                            <a href="{{ route('partner.recreation.packages', ['business_id' => $recreation->id]) }}" class="btn btn-secondary">Paket Rekreasi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
