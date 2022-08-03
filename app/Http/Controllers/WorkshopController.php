<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScriptWorkshop;
use App\Models\CreateWorkshop;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    public function scriptworkshop(Request $request){
        $user = Auth::user();
        $scriptworkshop=new ScriptWorkshop;
        $scriptworkshop->workshopTitle=$request->input('workshopTitle');
        $scriptworkshop->workShopLead=$request->input('workShopLead');
        $scriptworkshop->startDate=$request->input('startDate');
        $scriptworkshop->endDate=$request->input('endDate');
        // $scriptworkshop->scriptworkshopPic=$request->file('scriptworkshopPic')->store('Workshop');
        $scriptworkshop->description=$request->input('description');

        // $scriptworkshop->user_id=auth()->user()->id;
        // $scriptworkshop->user_id=$user->id;
        $scriptworkshop->user_id= Auth::id()->id;
        // $scriptworkshop->user_id=Auth::user()->id;

        $scriptworkshop->save();
        return response()->json([
            "success" => true,
            "scriptworkshop" => $scriptworkshop,
            "message" => "Script Workshop is Created."
        ]);
    }

    public function createworkshop(Request $request){
        
        $createworkshop = new CreateWorkshop;
        $createworkshop->workshopTitle=$request->input('workshopTitle');
        $createworkshop->instructer=$request->input('instructer');
        $createworkshop->workshopType=$request->input('workshopType');
        $createworkshop->LinkForWorkShop=$request->input('LinkForWorkShop');
        // $createworkshop->creatworkshopPic=$request->file('creatworkshopPic')->store('Workshop');
        $createworkshop->description=$request->input('description');
        $createworkshop->daytitle=$request->input('daytitle');
        $createworkshop->daydate=$request->input('daydate');
        $createworkshop->daytime=$request->input('daytime');
        $createworkshop->daydescription=$request->input('daydescription');
        // $createworkshop = Auth::user()->id;
        $createworkshop->save();
        return response()->json([
            "success" => true,
            "createworkshop" => $createworkshop,
            "message" => "Workshop is Created."
        ]);
    }
}
