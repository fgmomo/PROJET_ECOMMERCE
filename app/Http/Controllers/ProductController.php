<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function  produits(){
        $produits = Product::get();
        return view('admin.produits')->with('produit',$produits);
    }
    public function ajouterproduit(){
        $categories = Category::All();
        return view('admin.ajouterproduit')->with('categorie',$categories);
    }
    public function sauverproduit(Request $request){
    $request->validate(['product_name'=>'required|unique:products',
                            'product_price'=>'required',
                            'product_category'=>'required',
                            'product_image'=>'image||nullable||max:1999']);

            if($request->hasFile('product_image')){
                $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
            }
            else{
                $fileNameToStore = 'noimage.jpg';
            }
            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_price = $request->input('product_price');
            $product->product_category = $request->input('product_category');
            $product->product_image = $fileNameToStore;
            $product->status = 1;
            $product->save();
            return redirect('/ajouterproduit')->with('status','Le Produit '.$product->product_name.'a été insérer avec success');
        }
        public function edit_produit($id){
            $categories = Category::All();
            $product = Product::find($id);
            return view('admin.editproduit')->with('produit',$product)->with('categorie',$categories);
        }
        public function modifierproduit(Request $request){

            $request->validate(['product_name'=>'required',
                                 'product_price'=>'required',
                                'product_category'=>'required',
                                'product_image'=>'image|nullable|max:1999']);

                                $product = Product::find($request->input('id'));
                                $product->product_name = $request->input('product_name');
                                $product->product_price = $request->input('product_price');
                                $product->product_category = $request->input('product_category');

            if($request->hasFile('product_image')){
                $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);

                if($product->product_image != 'noimage.jpg'){
                    Storage::delete('public/'.$product->product_image);
            }
            $product->product_image = $fileNameToStore;
        }
        $product->update();
        return redirect('/produits')->with('status','Le Produit '.$product->product_name.' a été modifié avec succès');
    }

    public function delete_produit($id){

        $product = Product::find($id);
        if($product->product_image != 'noimage.jpg'){
            Storage::delete('public/'.$product->product_image);
    }
        $product->delete();
      return redirect('/produits')->with('Supstatus','La Catégorie '.$product->product_name.' a été supprimée avec succès');
    }

    public function activer_produit($id){
        $product = Product::find($id);
        $product->status = 1;
        $product->update();
        return redirect('/produits')->with('status','Le Produit '.$product->product_name.' a été activé avec succès');

    }
    public function desactiver_produit($id){
        $product = Product::find($id);
        $product->status = 0;
        $product->update();
        return redirect('/produits')->with('status','Le Produit '.$product->product_name.' a été desactivé avec succès');

    }
}
