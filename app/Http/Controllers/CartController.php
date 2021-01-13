<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Cart;
use Auth;
use Alert;


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
                    /* $hasil = $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];

                    echo $hasil; */

                    Cart::update($row->rowId, ['option' =>[
                        'code' =>$data['rajaongkir']['results'][0]['code'],
                        'name' =>$data['rajaongkir']['results'][0]['name'],
                        'name' =>$data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'],
                        'etd'  =>$data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['etd'],
                    ]]);
                    return Cart::content();
                }
            }
        }
    }
}
