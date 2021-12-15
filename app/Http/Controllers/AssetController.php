<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Assettype;

class AssetController extends Controller
{
    //
    public function Assets()
    {
        return view('AddAssets');
    }



    /**
     * For showing all assets wrt pagination
     *
     * @return void
     */
    public function ShowAssets()
    {
        $data = Asset::paginate(4);
        return view('Assets', compact('data'));
    }


    /**
     * For adding assets
     *
     * @param Request $req
     * @return void
     */
    public function InsertAssets(Request $req)
    {
        $validateData = $req->validate([
            'name' => 'required',
            'assettype' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,jfif,PNG,JPEG,JPG'
        ], [
            'name.required' => 'Asset name is required',
            'assettype.required' => 'Select one',
            'quantity.required' => 'Enter the quantity',
            'status.required' => 'Select the status',
            'image.required' => 'Image is required',
            'image.mimes' => 'Incorrect format',
        ]);
        if ($validateData) {
            $uuid = substr(time() . rand(), 2, 16);
            $filename = $req->name . rand() . "." . $req->image->extension();
            if ($req->image->move(public_path('storage/'), $filename)) {
                $asp = Assettype::where('id', $req->assettype)->first();
                Asset::insert([
                    'name' => $req->name,
                    'uuid' => $uuid,
                    'type' => $asp->name,
                    'assettype_id' => $req->assettype,
                    'quantity' => $req->quantity,
                    'status' => $req->status,
                    'image' => $filename,
                ]);
                return redirect('/Assets');
            } else {
                return back()->with("msg", "not uploaded");
            }
        }
    }



    /**
     * For editing assets based on id
     *
     * @param [type] $id
     * @return void
     */
    public function EditAssets($id)
    {
        $data = Asset::findOrFail($id);
        $asp = Assettype::all();

        return view('EditAssets', compact('data', 'asp'));
    }



    /**
     * For updating assets based on id
     *
     * @param Request $req
     * @return void
     */
    public function UpdateAssets(Request $req)
    {
        $asp = Assettype::where('id', $req->assettype)->first();
        $validateData = $req->validate([
            'name' => 'required',
            'assettype' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'Asset name is required',
            'assettype.required' => 'Select one',
            'quantity.required' => 'Enter the quantity',
            'status.required' => 'Select the status',
        ]);
        if ($validateData) {
            Asset::where('id', $req->uid)->update([
                'name' => $req->name,
                'type' => $asp->name,
                'assettype_id' => $req->assettype,
                'quantity' => $req->quantity,
                'status' => $req->status,
            ]);

            return redirect('/Assets');
        }
    }



    /**
     * For Deleting assets based on id
     *
     * @param [type] $id
     * @return void
     */
    public function DeleteAssets($id)
    {
        Asset::findOrFail($id)->delete();
        return redirect('/Assets');
    }
}
