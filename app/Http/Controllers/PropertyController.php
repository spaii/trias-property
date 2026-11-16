<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    
    public function index()
    {
        $materials = Material::all()->groupBy('category');
        $oldSpecs = session('form_specs', []);

        return view('home', compact('materials', 'oldSpecs'));
    }

    public function calculate(Request $request)
    {
        $messages = [
            'tipe_rumah.required'    => 'Mohon pilih Tipe Rumah.',
            'pondasi.required'       => 'Bahan Pondasi belum dipilih.',
            'dinding.required'       => 'Bahan Dinding belum dipilih.',
            'lantai.required'        => 'Bahan Lantai belum dipilih.',
            'kaso_reng.required'     => 'Bahan Kaso & Reng belum dipilih.',
            'genteng.required'       => 'Bahan Genteng belum dipilih.',
            'plafon.required'        => 'Bahan Plafon belum dipilih.',
            'pintu_jendela.required' => 'Bahan Pintu & Jendela belum dipilih.',
            'listrik.required'       => 'Daya Listrik belum dipilih.',
            'pagar.required'         => 'Bahan Pagar belum dipilih.',
            'warna.required'         => 'Pilihan Warna belum dipilih.',
        ];

        $request->validate([
            'tipe_rumah'    => 'required',
            'pondasi'       => 'required',
            'dinding'       => 'required',
            'lantai'        => 'required',
            'kaso_reng'     => 'required',
            'genteng'       => 'required',
            'plafon'        => 'required',
            'pintu_jendela' => 'required',
            'listrik'       => 'required',
            'pagar'         => 'required',
            'warna'         => 'required',
        ], $messages);

        session([
            'form_specs' => $request->except('_token')
        ]);

        $totalPrice = 0;
        $selectedSpecs = [];

        $houseType = Material::findOrFail($request->tipe_rumah);
        $totalPrice += $houseType->price;
        $selectedSpecs[] = $houseType;

        $factor = $houseType->multiplier;

        foreach ($request->except(['_token', 'tipe_rumah']) as $value) {
            $material = Material::find($value);

            if ($material) {
                if (in_array($material->category, ['listrik', 'pagar', 'pintu_jendela', 'warna'])) {
                    $realPrice = $material->price;
                } else {
                    $realPrice = $material->price * $factor;
                }

                $totalPrice += $realPrice;
                $material->price = $realPrice;
                $selectedSpecs[] = $material;
            }
        }

        $hpp = $totalPrice;
        $profit = $hpp * 0.10;
        $totalPrice = $hpp + $profit;

        session([
            'specs'       => $selectedSpecs,
            'total_price' => $totalPrice,
            'hpp'         => $hpp,
        ]);

        return view('summary', compact('selectedSpecs', 'totalPrice'));
    }

    public function simulate(Request $request)
    {
        $request->validate([
            'dp' => 'required|numeric|min:0',
            'tenor' => 'required|numeric|min:6'
        ]);

        $totalPrice = session('total_price');

        if (!$totalPrice) {
            return redirect()->route('home')
                ->with('error', 'Sesi habis, silakan ulangi pemesanan.');
        }

        $dp = $request->dp;
        $tenorBulan = $request->tenor;
        $bungaTahun = 0.12;

        $pokok = $totalPrice - $dp;
        $tahun = $tenorBulan / 12;

        $totalBunga = $pokok * $bungaTahun * $tahun;
        $totalHutang = $pokok + $totalBunga;

        $angsuranPerBulan = $totalHutang / $tenorBulan;

        return view('result', compact(
            'totalPrice',
            'dp',
            'tenorBulan',
            'angsuranPerBulan',
            'totalHutang'
        ));
    }

    public function storeOrder(Request $request)
    {
        $specs = session('specs');
        $totalPrice = session('total_price');

        if (!$specs) {
            return redirect()->route('home')
                ->with('error', 'Sesi habis, silakan ulangi pemesanan.');
        }

        DB::transaction(function () use ($request, $specs, $totalPrice) {

            $order = Order::create([
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'customer_address' => $request->address ?? '-',
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
                'down_payment' => $request->dp ?? 0,
                'tenor_bulan' => $request->tenor ?? 0,
                'monthly_installment' => $request->installment ?? 0,
            ]);

            foreach ($specs as $spec) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'material_id' => $spec->id,
                    'price_at_moment' => $spec->price,
                ]);
            }
        });

        session()->forget(['specs', 'total_price', 'hpp', 'form_specs']);

        return view('thankyou', ['name' => $request->name]);
    }
}
