<?php

namespace App\Http\Controllers;

use App\Mail\BookTour;
use Illuminate\Http\Request;
use App\Mail\Contact;
use App\Mail\Enquiry;
use App\Mail\Lead;
use Mail;
use Session;
use App\Tour;

class MailController extends Controller
{
    public function fromContact(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'messageBody' => 'required',
            'answer'      => 'required'
        ]);
        if ($request->answer == 125) {
            $user_info = $this->getLocation($request->ip());

            $data = array(
                'name' => $request->full_name,
                'email' => $request->email,
                'subject' => $request->subject,
                'messageBody' => $request->messageBody,
                'user_info' => $user_info,
            );

            Mail::send(new Contact($data));
            Session::flash('success', 'Email sent sucessfully!');
            return redirect()->back();
        }
        else{
            Session::flash('error', 'Verification failed !');
            return redirect()->back();
        }
    }

    public function forEnquiry(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'messageBody' => 'required',
            'contact_number' => 'required'
        ]);
        $user_info = $this->getLocation($request->ip());
        $tour = Tour::where('id', '=', $request->tour_id)->first();
        $subject = "We have new enquiry for " . $tour->name . " " . $tour->days . " Days";
        $data = array(
            'name' => $request->full_name,
            'email' => $request->email,
            'country' => $request->country,
            'subject' => $subject,
            'messageBody' => $request->messageBody,
            'user_info' => $user_info,
        );

        Mail::send(new Enquiry($data));

        return ['message' => 'Message sent sucessfully.'];
    }

    public function forLead(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'messageBody' => 'required'
        ]);

        $user_info = $this->getLocation($request->ip());
        $tour = Tour::where('id', '=', $request->tour_id)->first();
        $subject = "We have new lead for" . " " . $tour->name . " " . $tour->days . " Days.";
        $data = array(
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'subject' => $subject,
            'messageBody' => $request->messageBody,
            'user_info' => $user_info,
        );
        Mail::send(new Lead($data));
        Session::flash('success', 'Email sent sucessfully!');
        return view('frontend.thank-you');
    }

    public function forBooking(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'detailedAddress' => 'required',
            'message' => 'sometimes'
        ]);

        $user_info = $this->getLocation($request->ip());
        $tour = Tour::where('id', '=', $request->tour_id)->first();
        $subject = "New Booking for" . $tour->name . " " . $tour->days . " Days.";
        $data = array(
            'travellersNo' => $request->travellersNo,
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->contact,
            'country' => $request->country,
            'subject' => $subject,
            'messageBody' => $request->messageBody,
            'user_info' => $user_info,
            'detailedAddress' => $request->detailedAddress
        );
        Mail::send(new BookTour($data));
        Session::flash('success', 'Booking sucessfully!');
        return view('frontend.thank-you');
    }

    public function getLocation($ipAddress)
    {

        $IPdata   = file_get_contents("http://api.ipstack.com/{$ipAddress}?access_key=6410177f4d950c7fa7b795a6bf27ac63");
        $IPdata   = json_decode($IPdata);
        $user_info = "IP: {$IPdata->ip} <br> [ Country: <b>{$IPdata->country_name}</b> | City: {$IPdata->city} ]";
        return $user_info;
    }
}
