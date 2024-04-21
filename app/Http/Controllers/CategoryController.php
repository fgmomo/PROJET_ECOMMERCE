<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::get();
        return view('admin.categories')->with('categories',$categories);
    }
    public function ajoutercategorie(){
        return view('admin.ajoutercategorie');
    }
    public function sauvercategorie(Request $request){
        $request->validate(['category_name'=>'required|unique:categories']);
        $categorie = new Category();
        $categorie->category_name = $request->input('category_name');
        $categorie->save();
      return redirect('/ajoutercategorie')->with('status','La Catégorie '.$categorie->category_name.' a été ajouté avec succès');
    }
    public function edit_categorie($id)
    {
        $categorie = Category::find($id);
         return view('admin.editcategorie')->with('categorie',$categorie);
    }


    public function modifiercategorie(Request $request)
    {
        $request->validate(['category_name'=>'required|unique:categories']);
        $categorie = Category::find($request->input('id'));
        $categorie->category_name = $request->input('category_name');
        $categorie->update();
      return redirect('/categories')->with('status','La Catégorie '.$categorie->category_name.' a été modifié avec succès');
    }

    public function  delete_categorie($id){
        $categorie = Category::find($id);
        $categorie->delete();
      return redirect('/categories')->with('Supstatus','La Catégorie '.$categorie->category_name.' a été supprimée avec succès');
    }
}
