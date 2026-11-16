@extends('layout')

@section('content')

    <div class="text-center mb-5">
        <h3 class="fw-bold">SILAHKAN MEMILIH UKURAN RUMAH ANDA & MATERIAL YANG AKAN DIGUNAKAN</h3>
        <p class="text-muted">Sesuaikan spesifikasi rumah dengan keinginan Anda dengan harga yang transparan</p>
        <hr class="mb-5" style="border-top: 3px solid #000; opacity: 1; width: 100%;">
    </div>
    

    @php
        $oldSpecs = $oldSpecs ?? [];
    @endphp

    @if ($errors->any())
    <div class="alert alert-danger mb-4">
        <strong>Perhatian! Ada bahan yang belum dipilih:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('calculate') }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-12 mb-4">
                <label class="fw-bold">Pilihan Tipe Ukuran Rumah (Base Price)</label>

                <select name="tipe_rumah"
                    class="form-select @error('tipe_rumah') is-invalid @enderror">

                    <option value="">-- Pilih Tipe Rumah --</option>

                    @foreach($materials['tipe_rumah'] ?? [] as $item)
                        <option value="{{ $item->id }}"
                            {{ (old('tipe_rumah') ?? ($oldSpecs['tipe_rumah'] ?? '')) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }} - Rp {{ number_format($item->price) }}
                        </option>
                    @endforeach
                </select>

                @error('tipe_rumah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @php 
                $labels = [
                    'pondasi'       => '1. Pilihan Pondasi',
                    'dinding'       => '2. Pilihan Dinding',
                    'lantai'        => '3. Pilihan Lantai',
                    'kaso_reng'     => '4. Pilihan Kaso & Reng',
                    'genteng'       => '5. Pilihan Genteng',
                    'plafon'        => '6. Pilihan Plafon',
                    'pintu_jendela' => '7. Pilihan Pintu & Jendela',
                    'listrik'       => '8. Pilihan Daya Listrik',
                    'pagar'         => '9. Pilihan Pagar',
                    'warna'         => '10. Pilihan Warna (Cat Dulux)',
                ]; 
            @endphp

            @foreach($labels as $key => $label)
                <div class="col-md-6 mb-3">
                    <label class="fw-bold">{{ $label }}</label>

                    <select name="{{ $key }}"
                        class="form-select @error($key) is-invalid @enderror">

                        <option value="">
                            @if($key == 'warna')
                                -- Pilih Warna (Harga Include: Rp 11.200.000) --
                            @else
                                -- Pilih Bahan --
                            @endif
                        </option>

                        @foreach($materials[$key] ?? [] as $item)
                            <option value="{{ $item->id }}"
                                {{ (old($key) ?? ($oldSpecs[$key] ?? '')) == $item->id ? 'selected' : '' }}>
                                
                                @if($key == 'warna')
                                    {{ $item->name }}
                                @else
                                    {{ $item->name }}
                                    ({{ $item->price > 0 ? '+ Rp '.number_format($item->price) : 'Standar' }})
                                @endif
                            </option>
                        @endforeach
                    </select>

                    @error($key)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-dark w-50 py-2 fw-bold shadow-sm">
                Hitung Estimasi Harga
            </button>
        </div>
    </form>

    @if ($errors->any())
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Form Belum Lengkap',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonText: 'OK'
    });
    </script>
    @endif

@endsection