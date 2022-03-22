<?php

namespace App\Http\Controllers;


use App\Models\ShortUrl;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    //
    public function short(Request $request)
    {
        $user = Auth::user()->id;
     
        $original_url = $request->original_url;
        $exp_time_number = $request->exp_time_number;
        $exp_time_duration = $request->exp_time_duration;        
        $staus = true;
        if($original_url)
        {
            $new_exp_time_duration = "";
            if($exp_time_duration == "hour"){
                $new_exp_time_duration = Carbon::now('UTC')->addHours($exp_time_number)->format('Y-m-d H:i:s');
            }else if($exp_time_duration == "minute"){
                $new_exp_time_duration = Carbon::now('UTC')->addMinutes($exp_time_number)->format('Y-m-d H:i:s');
            }else if($exp_time_duration == "sec"){
                $new_exp_time_duration = Carbon::now('UTC')->addSeconds($exp_time_number)->format('Y-m-d H:i:s');
            }
            $short_url = base_convert($new_exp_time_duration,5,18);
            if(auth()->user()){
                $new_url = auth()->user()->links()->create([
                    'original_url'=>$original_url,
                    'short_url'=>$short_url,
                    'status'=>$staus,
                    'expiry_date'=>$new_exp_time_duration
                ]);
            }
        
            return redirect()->route('short.exit')->with('short_url',$short_url);
        }
        return back();
        
    }
    
    public function show($code)
    {
        $short_url = ShortUrl::where('short_url',$code)->first();
        if($short_url)
        {
            return redirect()->to(url($short_url->original_url));
        }
        return redirect()->to('/');
    }

    public function update(Request $request)
    {
        $url_id = $request->url_id;
        $original_url = $request->original_url;
        $exp_time_number = $request->exp_time_number;
        $exp_time_duration = $request->exp_time_duration;        
        $status = true;

        if($original_url)
        {
            $new_exp_time_duration = "";
            if($exp_time_duration == "hour"){
                $new_exp_time_duration = Carbon::now('UTC')->addHours($exp_time_number)->format('Y-m-d H:i:s');
            }else if($exp_time_duration == "minute"){
                $new_exp_time_duration = Carbon::now('UTC')->addMinutes($exp_time_number)->format('Y-m-d H:i:s');
            }else if($exp_time_duration == "sec"){
                $new_exp_time_duration = Carbon::now('UTC')->addSeconds($exp_time_number)->format('Y-m-d H:i:s');
            }
            $short_url = base_convert($new_exp_time_duration,5,18);
            if(auth()->user()){
                $new_url = ShortUrl::find($url_id);
                $new_url->original_url = $original_url;
                $new_url->short_url = $short_url;
                $new_url->status = $status;
                $new_url->expiry_date = $new_exp_time_duration;
                $new_url->save();
            
            }
        
            return redirect()->route('short.exit')->with('short_url',$short_url);
        }
        return back();
    }
}
