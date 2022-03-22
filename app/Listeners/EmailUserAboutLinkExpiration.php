<?php

namespace App\Listeners;

use App\Events\LinkExpired;
use App\Mail\ExpiredUrlEmail;
use Illuminate\Support\Facades\DB;
use App\Models\ShortUrl;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutLinkExpiration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LinkExpired $event)
    {
        $today_date = Carbon::now();
        $user_id = auth()->user()->id;
        $data = false;
       $expired_url = DB::table('short_urls')->where('user_id',$user_id)->whereDate('expiry_date','<',$today_date);
       if($expired_url->count() >= 1)
       {
        $short_urls = $expired_url->get();
           foreach($short_urls as $url)
           {
               $data = [
                   'original_url'=>$url->original_url,
                   'short_url'=>$url->short_url
               ];
               Mail::to($event->email)->send(new ExpiredUrlEmail($data));
               
           }           
           
       }
    }
}
