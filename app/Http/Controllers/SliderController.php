<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
      public function  sliders()
    {
        $slider = Slider::get();
        return view('admin.sliders')->with('sliders', $slider);
    }
    public function ajouterslider()
    {
        return view('admin.ajouterslider');
    }
    public function sauverslider(Request $request)
    {
        $request->validate([
            'description1' => 'required',
            'description2' => 'required',
            'slider_image' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('slider_image')) {
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $slider = new Slider();

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->slider_image = $fileNameToStore;
        $slider->status = 1;
        $slider->save();
        return redirect('/ajouterslider')->with('status', 'Le Slider a été insérer avec success');
    }
    public function edit_slider($id)
    {
        $slider = Slider::find($id);
        return view('admin.editslider')->with('sliders', $slider);
    }
    public function modifierslider(Request $request)
    {
        $request->validate([
            'description1' => 'required',
            'description2' => 'required',
            'slider_image' => 'image|nullable|max:1999'
        ]);
        $slider = Slider::find($request->input('id'));

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');


        if ($request->hasFile('slider_image')) {
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            if ($slider->slider_image != 'noimage.jpg') {
                Storage::delete('public/' . $slider->slider_image);
            }
            $slider->slider_image = $fileNameToStore;
        }
        $slider->update();
        return redirect('/sliders')->with('status', 'Le Slider  a été modifié avec succès');
    }
    public function delete_slider($id){
        $slider = Slider::find($id);
        if($slider->slider_image != 'noimage.jpg'){
            Storage::delete('public/'.$slider->slider_image);
    }
        $slider->delete();
      return redirect('/sliders')->with('Supstatus','Le slider a été supprimée avec succès');
    }
    public function activer_slider($id){
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->update();
        return redirect('/sliders')->with('status','Le Slider a été activé avec succès');

    }
    public function desactiver_slider($id){
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->update();
        return redirect('/sliders')->with('status','Le Slider  a été desactivé avec succès');

    }
}
