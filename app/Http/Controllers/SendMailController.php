<?php

namespace App\Http\Controllers;

use App\Models\Dinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

class SendMailController extends Controller
{
    public function send()
    {
        $details = [
            'title' => 'Email dari Dinas PU Sumenep',
            'body' => 'Ini adalah test dari email send'
        ];

        try {

            Mail::to('dannyalfandi06@gmail.com')->send(new \App\Mail\MyMail($details));
            echo "Email berhasil dikirim.";

        } catch(\Exception $e){
            echo "Email gagal dikirim karena $e.";
        }


    }
}
