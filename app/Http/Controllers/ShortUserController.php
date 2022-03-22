<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\LinkExpired;
use App\Models\ShortUrl;

class ShortUserController extends Controller
{
    public function index()
    {
        $links = auth()->user()->links;
        $user_email = auth()->user()->email;
        event(new LinkExpired($user_email));
        return view('home', compact('links'));
    }

    public function show($id)
    {
        $short_url_info = ShortUrl::where('id',$id)->first();
        return view('linkop.show',['short_url_info'=>$short_url_info]);

    }

    public function update($id)
    {
        $short_url_info = ShortUrl::where('id',$id)->first();
        return view('linkop.update',['short_url_info'=>$short_url_info]);
    }

    public function disable($id)
    {
        $short_url = ShortUrl::find($id);
        $short_url->status = false;
        $short_url->save();
        return redirect()->back();
    }

    public function enable($id)
    {
        $short_url = ShortUrl::find($id);
        $short_url->status = true;
        $short_url->save();
        return redirect()->back();
    }

    public function destory($id)
    {
        $short_url = ShortUrl::find($id);
        $short_url->delete();
        return redirect()->back();
    }

 
}
