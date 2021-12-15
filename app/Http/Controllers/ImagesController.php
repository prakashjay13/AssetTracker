<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Assetimage;

class ImagesController extends Controller
{
    //
    /**
     * For dispalying image wrt id
     *
     * @param [type] $id
     * @return void
     */
    public function ImageShow($id)
    {
        $data = Asset::where('id', $id)->first();
        return view('ImageUploading', compact('data'));
    }


/**
 * For adding more asset images
 *
 * @param Request $req
 * @return void
 */
    public function UploadImage(Request $req)
    {
        $filename = $req->name . rand() . "." . $req->image->extension();
        if ($req->image->move(public_path('storage/'), $filename)) {
            Assetimage::insert([
                'img_path' => $filename,
                'asset_id' => $req->uid,
            ]);
            return redirect('/Assets');
        } else {
            return back()->with("msg", "not uploaded");
        }
    }



/**
 * For Displaying Asset Images
 *
 * @param [type] $id
 * @return void
 */
    public function ShowImage($id)
    {
        $ast = Asset::findOrFail($id);
        $imgs = $ast->Images;
        return view('ShowImage', compact('imgs', 'ast'));
    }
}
