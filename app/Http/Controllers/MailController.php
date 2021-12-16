<?php

namespace App\Http\Controllers;

use App\Mail\BookTour;
use Illuminate\Http\Request;
use App\Mail\Contact;
use App\Mail\Enquiry;
use App\Mail\Lead;
use App\Mail\PlanTrip;
use App\Setting;
use Illuminate\Support\Facades\View;
use Mail;
use Session;
use App\Tour;

class MailController extends Controller
{
    public function __construct()
    {
        $setting = Setting::firstOrFail();
        $metaImages = (object) [
            'ogTag' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL') . '/tr:n-OGTag', $setting->cover),
            'twitter' => str_replace(env('IMAGE_KIT_URL'), env('IMAGE_KIT_URL') . '/tr:n-twitter', $setting->cover)
        ];
        View::share('metaImages', $metaImages);
    }

    public function fromContact(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'messageBody' => 'required',
        ]);

        $token = $request->input('g-recaptcha-response');
        if (strlen($token) > 0) {
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
        } else {
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

    public function planTripPost(Request $request)
    {
        try {
            $data = array(
                'subject' => 'New trip plan request',
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->telephone,
                'country' => $request->country,
            );
            //travel type
            switch ($request->travelType) {
                case '1':
                    $data['travelType'] = 'Solo';
                    break;
                case '2':
                    $data['travelType'] = 'Couple/2 person';
                    break;
                case '3':
                    $data['travelType'] = 'Family';
                    break;
                case '4':
                    $data['travelType'] = 'Group';
                    break;
                default:
                    # code...
                    break;
            }
            // if ($request->adult) {
                $data['adult'] = $request->adult;
            // }
            // if ($request->children) {
                $data['children'] = $request->children;
            // }
            //travel date
            switch ($request->travelDate) {
                case '1':
                    $data['travelDate'] = 'I have fixed travel date.';
                    break;
                case '2':
                    $data['travelDate'] = 'This is my approx. travel date';
                    break;
                case '3':
                    $data['travelDate'] = 'We are still planning';
                    break;
                default:
                    # code...
                    break;
            }

            // if ($request->startDate) {
                $data['startDate'] = $request->startDate;
            // }
            // if ($request->endDate) {
                $data['endDate'] = $request->endDate;
            // }

            if ($request->haveTrip) {
                $data['haveTrip'] = "I have already fixed my tour destination.";
                $tour = Tour::where('id', '=', $request->tripNameSelect)->first(['name', 'days']);
                $data['tripName'] = $tour->days . ' Days(s) - ' . $tour->name;
            } else {
                $data['haveTrip'] = "I need guidence on planning my trip.";
                $data['tripName'] = $request->tripNameInput;
            }
            $data['description'] = $request->description;

            $data['user_info'] = $this->getLocation($request->ip());;
            Mail::send(new PlanTrip($data));
            //return json response of success and status 200
            return response()->json(['status'=>'success', 'message' => 'Request sent successfully!'], 200);
        } catch (\Throwable $th) {
            $e=[];
            $e['message']=$th->getMessage();
            $e['file']=$th->getFile();
            $e['line']=$th->getLine();
            $e['trace']=$th->getTrace();
            return $e;
            //return json response of error and status 500
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function getLocation($ipAddress)
    {

        // $url = "http://api.ipstack.com/{$ipAddress}?access_key=6410177f4d950c7fa7b795a6bf27ac63";
        $url = "http://www.geoplugin.net/php.gp?ip={$ipAddress}&lang=en";
        if (ini_get('allow_url_fopen')) {
            $IPdata   = file_get_contents($url);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
            $IPdata = curl_exec($ch);
            curl_close($ch);
        }

        $IPdata = unserialize($IPdata);
        $user_info = "
        IP: {$ipAddress} <br> 
        [ Country: <b>{$IPdata['geoplugin_countryName']}</b> |  Region: {$IPdata['geoplugin_regionName']} | City: {$IPdata['geoplugin_city']} ]";
        return $user_info;
    }
}
