<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status',1)->get();
        $product = Product::where('status',1)->get();
        return view('client.home')->with('sliders',$sliders)->with('produits',$product);
    }
    public function shop()
    {
        $categorie = Category::get();
        $produit = Product::where('status',1)->get();
        return view('client.shop')->with('categories',$categorie)->with('produits',$produit);
    }
    public function select_par_cat($name){
        $categorie = Category::get();
        $produit = Product::where('product_category',$name)->where('status',1)->get();
          return view('client.shop')->with('categories',$categorie)->with('produits',$produit);
 }

 public function ajouter_au_panier($id){
    $produit = Product::find($id);
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->add($produit, $id);
    Session::put('cart', $cart);

    return redirect('/shop');
 }
 public function modifier_panier(Request $request ,  $id){
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->updateQty( $id, $request->quantity);
    Session::put('cart', $cart);

    //dd(Session::get('cart'));
    return redirect('/panier');
 }

 public function retirer_produit($id){
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);

    if(count($cart->items) > 0){
        Session::put('cart', $cart);
    }
    else{
        Session::forget('cart');
    }

    //dd(Session::get('cart'));
    return redirect('/panier');
 }
    public function panier()
    {
        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);

    }
    public function creer_compte(Request $request){
        $request->validate([
            'email' => 'email|required|unique:clients',
            'password' => 'required|min:4',
        ]);
        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();

        return back()->with('status','Votre compte a été créé avec Succès');
    }
    public function acceder_compte(Request $request){
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:4',
        ]);

        $client = Client::where('email',$request->input('email'))->first();
        if ($client) {
            if (Hash::check($request->input('password'), $client->password)) {
                Session::put('client', $client);
                return redirect('/shop');
            } else {
                return back()->with('status', 'Mauvais mot de Passe ou email');
            }
        } else {
            return back()->with('status', 'Vous n\'avez pas de compte');
        }
    }
    public function  logout()
    {
        Session::flush();
       return redirect('/login');
    }
    public function client_login()
    {
        return view('client.login');
    }
    public function signup()
    {
        return view('client.signup');
    }
    public function paiement()
    {
        return view('client.checkout');
    }
}
