<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Cart;
use Auth;
use Alert;
use App\Transaction;

class CartController extends Controller
{
    protected $category;
    public function __construct()
    {
        $this->category = Category::where('parent_id', null)->get(); //parent_id tidak null maka diambildatanya
    }
    public function index(Request $request)
    {
        // Cart::destroy();/* hidupkan ini untuk menghapus */
        $product = Product::find($request->id);
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $request->qty, 'price' => $product->price]);
        // return Cart::content();/* Menampilkan dalam bentuk json */
        return redirect('keranjang');
    }

    public function keranjang()
    {
        $category = $this->category;
        return view('homepage.keranjang', compact('category'));
    }

    public function update(Request $request)
    {
        Cart::update($request->rowid, $request->qty);
        $category = $this->category;
        Alert::success('', 'Keranjang Belanja Berhasil di perbaharui');
        return redirect('keranjang');
    }
    public function delete( $rowid)
    {
        Cart::remove($rowid);
        $category = $this->category;
        Alert::success('', 'Keranjang Belanja Berhasil di perbaharui');
        return redirect('keranjang');
    }

    public function formulir()
    {
        $category = $this->category;
        return view('homepage.formulir', compact('category'));

    }

    public function transaction(Request $request)
    {
        foreach(Cart::content() as $row){
            $product = Product::find($row->id);
            $city = json_decode(City(), true);
            $weight = $product->weight * $row->qty;//kalkulasi jumlah barang yang dipesan
            foreach ($city['rajaongkir']['results'] as $key) {
                // echo $key['city_id'];
                if($product->user->address == $key['city_name']){
                    // echo "Haii";
                    $cost =Cost($key['city_id'], $request->city, $weight, $request->eks);
                    $data = json_decode($cost, true);
                    // $hasil = $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

                    // echo $hasil;

                    Cart::update($row->rowId, ['options' =>[
                        'code' =>$data['rajaongkir']['results'][0]['code'],
                        'name' =>$data['rajaongkir']['results'][0]['name'],
                        'value' =>$data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'],
                        'etd'  =>$data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['etd'],
                    ]]);
                    // return Cart::content();
                    $eks = [
                        'code'  => $row->options->code,
                        'name'  => $row->options->name,
                        'value' => $row->options->value,
                        'etd'  => $row->options->etd,
                    ];
                    $transaction = new Transaction;
                    $transaction->code = date('ymdhi'). Auth::user()->id;
                    $transaction->user_id = Auth::user()->id;
                    $transaction->qty = $row->qty;
                    $transaction->subtotal = $row->subtotal;
                    $transaction->name = $request->name;
                    $transaction->address = $request->city;
                    $transaction->portal_code = $request->portal_code;
                    $transaction->ekspedisi = $eks;
                    $transaction->product_id = $product->id;
                    $transaction->save();
                    Cart::remove($row->rowId);
                }
            }
            if(Cart::count()== 0){
                return redirect('sds');
            }
        }
    }

    public function myorder()
    {
        $category = $this->category;
        $transaction = Transaction::groupBy('code')->orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->get();
        return view('homepage.myorder', compact('category', 'transaction'));
    }

    public function detail($code)
    {
        $category = $this->category;

        $transaction = Transaction::groupBy('code')->orderBy('id', 'DESC')->where('code', $code)->first();
        $transactiondetail = Transaction::orderBy('id', 'DESC')->where('code', $code)->get();
        return view('homepage.detailtransaksi', compact('category','transaction', 'transactiondetail'));
    }
    public function myproduct()
    {
        $category = $this->category;

        $product = Product::where('user_id', Auth::user()->id)->get();
        return view('homepage.myproduct', compact('product', 'category'));
    }

    public function addproduct()
    {
        $category = $this->category;
        // $categorys = Category::where('parent_id', null)->get();

        return view('homepage.addproduct', compact('category'));
    }


    public function saveproduct(Request $request)
    {
        // dd($request);
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $request->file('file')->move('static/dist/img/', $filename);
        $product = new Product;
        $product->slug = $request->slug;
        $product->photo = 'static/dist/img/' . $filename;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->user_id = Auth::user()->id;
        $product->save();
        Alert::success('', 'Product Berhasil di Tambahkan');
        return redirect('myproduct');
    }
}
