<?php

namespace App\Http\Controllers;

use App\Mail\rfqMail;
use App\Models\rfq;
use App\Models\rfqObejects;
use App\Models\settings;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\Count;

class rfqController extends Controller implements ShouldQueue
{
    //

    public function store(Request $request)
    {


        $request->validate([
            'rname' => 'required',
            'remail' => 'required',
            'object_ids' => 'required',
        ]);

        $requestcode = -1;
        $requestmsg = null;

        if (Count($request->object_ids) > 0) {
            $rfq = rfq::create([
                'rname' => $request->rname,
                'remail' => $request->remail,
                'rphone' => $request->phone,
                'rcontent' => $request->rcontent,
            ]);

            if ($rfq) {
                foreach ($request->object_ids as $item) {
                    rfqObejects::create([
                        'rfq_id' => $rfq->id,
                        'object_id' => $item
                    ]);
                }
            }



            $requestcode = 200;
            $requestmsg = 'Success';
        } else {
            $requestcode = 601;
            $requestmsg = 'no product for rfq';
        }

        //$this->sendMailNotif($request);

        if ($requestcode != 200) {
            return redirect()->back()->withErrors(['code' => $requestcode, 'msg' => $requestmsg]);
        } else {
            return redirect()->back()->withSuccess(['code' => $requestcode, 'msg' => $requestmsg]);
        }
    }

    public function sendMailNotif(Request $request)
    {
        try {
            $settings = settings::orderBy("created_at", "desc")->take(1)->get();

            Mail::to([$settings[0]->email, $request->remail])->send(new rfqMail($request));

            return true;
        } catch (Exception $exc) {

            return false;
        }
    }
}
