@extends('layout')

@section('content')
<h4 class="text-center">Simulasi Angsuran Flat (12%)</h4>
<table class="table table-bordered mt-4">
    <tr>
        <td>Harga Rumah</td>
        <td class="text-end">Rp {{ number_format($totalPrice) }}</td>
    </tr>
    <tr>
        <td>Down Payment (DP)</td>
        <td class="text-end text-danger">- Rp {{ number_format($dp) }}</td>
    </tr>
    <tr>
        <td>Pokok Hutang</td>
        <td class="text-end">Rp {{ number_format($totalPrice - $dp) }}</td>
    </tr>
    <tr class="table-primary fw-bold">
        <td>Angsuran per Bulan ({{ $tenorBulan }}x)</td>
        <td class="text-end">Rp {{ number_format($angsuranPerBulan) }}</td>
    </tr>
</table>

<div class="mt-4">
    <h5>Isi Data Diri Pemesan</h5>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        
        <input type="hidden" name="payment_method" value="CREDIT">
        <input type="hidden" name="dp" value="{{ $dp }}">
        <input type="hidden" name="tenor" value="{{ $tenorBulan }}">
        <input type="hidden" name="installment" value="{{ $angsuranPerBulan }}">
        
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nomor HP / WA</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <button class="btn btn-success w-100 btn-lg">Kirim Pesanan</button>
    </form>
</div>
@endsection