@extends('layout')

@section('content')
<h4>Rincian Pesanan</h4>
<ul class="list-group mb-4">
    @foreach($selectedSpecs as $spec)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $spec->name }}
            <span>Rp {{ number_format($spec->price) }}</span>
        </li>
    @endforeach
    <li class="list-group-item active d-flex justify-content-between">
        <strong>TOTAL HARGA RUMAH</strong>
        <strong>Rp {{ number_format($totalPrice) }}</strong>
    </li>
</ul>

<div class="alert alert-info">Apakah Anda yakin dengan spesifikasi ini?</div>

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('home') }}" class="btn btn-warning w-100">Ubah Spesifikasi</a>
    </div>
    <div class="col-md-6">
        <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#paymentOption">
            Lanjut ke Pembayaran
        </button>
    </div>
</div>

<div class="collapse mt-4" id="paymentOption">
    <div class="card card-body">
        <h5>Metode Pembayaran</h5>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#cash">CASH</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#credit">KREDIT (KPR)</button>
            </li>
        </ul>

        <div class="tab-content pt-3">
            <div class="tab-pane fade show active" id="cash">
    <p>Harga Tunai: <strong>Rp {{ number_format($totalPrice) }}</strong></p>
    
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <input type="hidden" name="payment_method" value="CASH">
        
        <input type="text" name="name" class="form-control mb-2" placeholder="Nama Lengkap" required>
        <input type="text" name="phone" class="form-control mb-2" placeholder="No HP" required>
        <textarea name="address" class="form-control mb-2" placeholder="Alamat Lengkap"></textarea>
        
        <button class="btn btn-success">Pesan Sekarang (Cash)</button>
    </form>
</div>

            <div class="tab-pane fade" id="credit">
                <form action="{{ route('simulate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Uang Muka (DP)</label>
                        <input type="number" name="dp" class="form-control" placeholder="Min 10%" required>
                    </div>
                    <div class="mb-3">
                        <label>Pilih Tenor (Bulan)</label>
                        <select name="tenor" class="form-select">
                            @for($i=12; $i<=120; $i+=12)
                                <option value="{{ $i }}">{{ $i }} Bulan ({{ $i/12 }} Tahun)</option>
                            @endfor
                        </select>
                    </div>
                    <button class="btn btn-primary w-100">Hitung Angsuran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection