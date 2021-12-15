<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Assettype;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    //
    public function AssetType()
    {
        return view('AssetType');
    }

    /**
     * For showing all assettypes
     *
     * @return void
     */
    public function DisplayAssetType()
    {
        $data = Assettype::all();
        return view("AssetType", compact('data'));
    }

    /**
     * For inserting assettypes
     *
     * @param Request $req
     * @return void
     */
    public function InsertAssetType(Request $req)
    {
        $validateData = $req->validate([
            'name' => 'required|unique:assettypes',
            "desc" => 'required|min:5|max:500'
        ], [
            'name.requried' => 'Name is required',
            'name.unique' => "Name is unique",
            'desc.required' => "Description is required",
        ]);
        if ($validateData) {
            Assettype::insert([
                'name' => $req->name,
                'description' => $req->desc,
            ]);
            return redirect('/AssetType');
        }
    }


    /**
     * For Viewing Pie chart
     *
     * @return void
     */
    public function PieChart()
    {
        $grp = DB::select(DB::raw("select sum(quantity)as total, name from assets group by assets.assettype_id"));
        $dat = "";
        foreach ($grp as $i) {
            $dat .= " ['" . $i->name . "'," . $i->total . "],";
        }
        $data = $dat;
        return view('PieChart', compact('data'));
    }


    /**
     * For Viewing Bar chart
     *
     * @return void
     */
    public function BarChart()
    {
        $grp = DB::select(DB::raw("SELECT type, sum(case WHEN status=1 then quantity else 0 end)
         as active, sum(case WHEN status=0 then quantity else 0 end) as inactive from assets group by type order by active;"));
        return view('BarChart', ['orders' => $grp]);
    }

    /**
     * Displaying assettypes wrt pagination
     *
     * @return void
     */
    public function ShowAssetType()
    {
        $data = Assettype::paginate(4);
        return view('AssetType', compact('data'));
    }


    /**
     * Editing assettypes based on id
     *
     * @param [type] $id
     * @return void
     */
    public function EditAssetType($id)
    {
        $data = Assettype::findOrFail($id);
        return view('EditAssetType', compact('data'));
    }

    /**
     * Updating assettypes based on id
     *
     * @param Request $req
     * @return void
     */
    public function UpdateAssetType(Request $req)
    {
        Assettype::where('id', $req->uid)->update([
            'name' => $req->name,
            'description' => $req->desc,
        ]);
        return redirect('/AssetType');
    }


    /**
     * Deleting assettypes based on id
     *
     * @param [type] $id
     * @return void
     */
    public function DeleteAssetType($id)
    {
        Assettype::findOrFail($id)->delete();
        return redirect('/AssetType');
    }
}
