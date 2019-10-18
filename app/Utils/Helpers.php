<?php

namespace App\Utils;

use App\Accommodation;
use App\AccomodationType;
use App\Activity;
use App\Package;
use App\PackageDestination;
use App\SearchImage;
use Carbon\Carbon;
use App\Country;
use App\AirlineCarrier;
use App\BottomOffer;
use App\Ticket;
use App\TicketPayment;
use App\PaymentPartner;
use App\Customer;
use App\AmadeusResponse;
use App\Banner;
use App\Advertisement;
use App\Booking;
use App\Airport;
use App\Content;
use Auth;
use Facades\App\Repositories\AirportRepository;
use Facades\App\Repositories\AirlineCarrierRepository;
use App\EmailTemplate;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Cache;
use App\Video;

class Helpers
{
    /**
     * Galileo Mins to Hr Min Format
     * 90mins => 1 hr 30 mins
     */
    public static function convert_hour_to_hourmin($time = null)
    {
        if ($time == null || $time < 1) {
            return "00 Hr 00 Mins";
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf('%02d hr %02d mins', $hours, $minutes);
    }


    /**
     * Amadues Time Difference
     * XX hr XX mins
     */
    public static function get_time_difference($start = null, $end = null)
    {
        if ($start == '' || $start == null || !$start || $end == '' || $end == null || !$end)
            return false;
        try {
            $start = Carbon::parse($start);
            $end = Carbon::parse($end);
            $totalDuration = $end->diffInSeconds($start);

            // return gmdate('H', $totalDuration)." hr ".gmdate('i', $totalDuration)." mins"; // Doesnt work if > 24 Hrs
            return sprintf('%02d hr %02d mins', ($totalDuration / 3600), ($totalDuration / 60 % 60));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Amadeus Time Difference in Seconds
     */
    public static function get_time_difference_in_secs($start = null, $end = null)
    {
        if ($start == '' || $start == null || !$start || $end == '' || $end == null || !$end)
            return false;
        try {
            $start = Carbon::parse($start);
            $end = Carbon::parse($end);
            $totalDuration = $end->diffInSeconds($start);
            return $totalDuration;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get Countires List
     */
    public static function get_countries()
    {
        $countries = Cache::rememberForever('get_countries', function () {
            return Country::orderBy('nationality', 'asc')->select('id', 'name', 'country_code', 'nationality')->get();
        });

        return count($countries) > 0 ? $countries : false;

        //$countries = Country::orderBy('nationality','asc')->select('id','name','country_code','nationality')->get();
        //return count( $countries ) > 0 ? $countries : false;
    }

    public static function get_countries_by_name()
    {
        $countries = Cache::rememberForever('get_countries_by_name', function () {
            return Country::orderBy('name', 'asc')->select('id', 'name', 'country_code', 'nationality')->get();
        });

        return count($countries) > 0 ? $countries : false;

        //$countries = Country::orderBy('name','asc')->select('id','name','country_code','nationality')->get();
        //return count( $countries ) > 0 ? $countries : false;
    }

    /**
     * Get bottom offers
     * Deals Section
     */
    public static function get_offer_deals()
    {
        //$bottom_offers = BottomOffer::where('status','1')->orderBy('orderby','asc')->get();

        $bottom_offers = Cache::rememberForever('bottom_offer', function () {
            return BottomOffer::where('status', '1')->orderBy('orderby', 'asc')->get();
        });

        return count($bottom_offers) > 0 ? $bottom_offers : false;
    }

    /**
     * Get CMS details by slug
     */
    public static function get_cms_by_slug($slug = null)
    {
        $cms = Content::where('type', 'info')->where('slug', $slug)->first();
        return $cms ? $cms : false;
    }

    /**
     * Get header banners offers
     */
    public static function get_header_banners()
    {
        $banners = Cache::rememberForever('get_header_banners', function () {
            return Banner::where('status', '1')->orderBy('orderby', 'asc')->take(4)->get();
        });

        return count($banners) > 0 ? $banners : false;

        //$banners = Banner::where('status','1')->where('banner_type','S')->orderBy('orderby','asc')->take(4)->get();
        //return count( $banners ) > 0 ? $banners : false;
    }

    public static function get_featured_video()
    {
        $video = Video::where('is_featured', '1')->first();

        return $video ? $video : false;
    }

    public static function get_videos()
    {
        $videos = Video::where(['is_featured' => '0', 'is_published' => '1'])->inRandomOrder()->limit(3)->get();

        return $videos->count() > 0 ? $videos : false;
    }

    /**
     * Get top ad. banners
     */
    public static function get_top_ads()
    {
        //$ads = Advertisement::where('status','1')->where('ad_type','top')->orderBy('orderby','asc')->take(4)->get();

        $ads = Cache::rememberForever('advertise_top', function () {
            return Advertisement::where('status', '1')->where('ad_type', 'top')->orderBy('orderby', 'asc')->take(4)->get();
        });

        return count($ads) > 0 ? $ads : false;
    }

    /**
     * Get bottom ad. banners
     */
    public static function get_bottom_ads()
    {
        //$ads = Advertisement::where('status','1')->where('ad_type','bottom')->orderBy('orderby','asc')->take(4)->get();

        $ads = Cache::rememberForever('advertise_bottom', function () {
            return Advertisement::where('status', '1')->where('ad_type', 'bottom')->orderBy('orderby', 'asc')->take(4)->get();
        });

        return count($ads) > 0 ? $ads : false;
    }

    /**
     * Get side ad. banners
     */
    public static function get_side_ads($no_of_ads = null)
    {

        /*$ads = Advertisement::where('status','1')
                              ->where('ad_type','side')
                              ->orderBy('orderby','asc');
        if ( $no_of_ads != null && $no_of_ads != 'all' ) {

            $ads->take($no_of_ads);
        }

        $side_ads = $ads->get();*/

        $side_ads = Cache::rememberForever('advertise_side', function () use ($no_of_ads) {

            $side_ads_qry = Advertisement::where('status', '1')
                ->where('ad_type', 'side')
                ->orderBy('orderby', 'asc');

            if ($no_of_ads != null && $no_of_ads != 'all') {
                $side_ads_qry->take($no_of_ads);
            }

            $side_ads = $side_ads_qry->get();

            return $side_ads;
        });

        return count($side_ads) > 0 ? $side_ads : false;
    }

    /**
     * Generating user code
     */
    public static $usercode_limit_counter = 1;

    public static function generateUserCode()
    {
        $user_code = str_random(32);
        if (Customer::where('user_code', $user_code)->count() == 0)
            return $user_code;
        if (self::$usercode_limit_counter > 100)
            return false;
        self::$usercode_limit_counter++; // setting time out to prevent from infinite looping
        self::generateUserCode();
    }


    /**
     * Payment partners list
     */
    public static function get_payment_partners()
    {
        //$partners = PaymentPartner::where('active','1')->orderBy('orderby','asc')->get();

        $partners = Cache::rememberForever('f1_paymentpartner', function () {
            return PaymentPartner::where('active', '1')->orderBy('orderby', 'asc')->get();
        });

        return count($partners) > 0 ? $partners : false;
    }

    /**
     * AMADEUS RESPONSE FOR DEBUGGING
     * Access /amadeus-debug/{booking_code}
     */
    public static function storeAmadeusResponse($booking_id = null, $booking_code = null, $status = null, $response = null)
    {
        /**
         * Returning true in every case to prevent break in Flow
         */
        if ($booking_id == null || $booking_code == null || $status == null || $response == null)
            return true;

        try {
            $in_data = [
                'booking_id'   => $booking_id,
                'booking_code' => $booking_code,
                'status'       => $status,
                'response'     => json_encode($response),
                'created_at'   => config('constants.current_date_time'),
                'updated_at'   => config('constants.current_date_time'),
            ];
            AmadeusResponse::insert($in_data);
            return true;
        } catch (\Exception $e) {
            return true;
        }
    }

    /**
     * Create Ticket Record
     */
    public static function creteTicketRecord($ticket_create_payload = null)
    {
        if ($ticket_create_payload == null || count($ticket_create_payload) == 0)
            return false;

        try {
            $bank_charge = isset($ticket_create_payload['bank_charge']) ? $ticket_create_payload['bank_charge'] : 0;

            // ticket data
            $ticket_insert_data = [
                'api_source'     => $ticket_create_payload['booking_details']->api_source,
                'customer_id'    => $ticket_create_payload['booking_details']->customer_id,
                'booking_id'     => $ticket_create_payload['booking_details']->id,
                'trip_type'      => $ticket_create_payload['booking_details']->trip_type,
                'ticket_ref_no'  => isset($ticket_create_payload['ticket_ref_no']) ? $ticket_create_payload['ticket_ref_no'] : "",
                'payment_status' => 'complete',
                'currency_used'  => $ticket_create_payload['booking_details']->currency_used,
                'base_fare'      => $ticket_create_payload['booking_details']->base_fare,
                'total_tax'      => $ticket_create_payload['booking_details']->total_tax,
                'total_fare'     => $ticket_create_payload['booking_details']->base_fare + $ticket_create_payload['booking_details']->total_tax,
                'total_sasto'    => $ticket_create_payload['booking_details']->total_sasto + $bank_charge,
                'sold_price'     => $ticket_create_payload['booking_details']->total_fare + $bank_charge,
                'handcarry'      => $ticket_create_payload['booking_details']->cabin_baggage,
                'baggage'        => $ticket_create_payload['booking_details']->checking_baggage,
                'email_sent'     => 'no',
                'created_at'     => config('constants.current_date_time'),
                'updated_at'     => config('constants.current_date_time'),
            ];
            $ticket_id = Ticket::insertGetId($ticket_insert_data);

            // updating payments table
            $payment_insert_data = [
                'ticket_id'         => $ticket_id,
                'payment_mode'      => isset($ticket_create_payload['payment_gateway_name']) ? $ticket_create_payload['payment_gateway_name'] : "",
                'payment_logo'      => isset($ticket_create_payload['payment_gateway_logo']) ? $ticket_create_payload['payment_gateway_logo'] : "",
                'payment_reference' => isset($ticket_create_payload['payment_reference']) ? $ticket_create_payload['payment_reference'] : "",
                'created_at'        => config('constants.current_date_time'),
                'updated_at'        => config('constants.current_date_time'),
            ];
            TicketPayment::insert($payment_insert_data);

            return $ticket_id;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get Airport Codes for No of Stops
     */
    public static function getAiportCodeArray($conn_flights = [])
    {
        if (count($conn_flights) <= 1)
            return [];

        try {
            array_shift($conn_flights); // removing first element from array
            return array_pluck($conn_flights, 'locationDeparture');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Domestic or International Flight
     */
    public static function isDomesticInternational($airports = [])
    {
        if (count($airports) == 0) {
            return "international";
        }
        $airport_count = Airport::whereIn('code', $airports)->groupBy('country_id')->pluck('country_id')->count();
        return $airport_count == '1' ? 'domestic' : 'international';
    }

    /**
     * Purfying HTML with HTML Purifriyer
     */
    public static function sanitize_html($dirtyHTML = null)
    {
        if ($dirtyHTML == null) {
            return null;
        }

        try {

            $purifier = new \HTMLPurifier();
            return $purifier->purify($dirtyHTML);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * get destinations
     */
    public static function get_destinations()
    {
        return PackageDestination::where('status', 1)->select('id', 'name', 'code')->get();
    }

    /**
     * get accommodation type. ie hotel stars
     */
    public static function get_accommodation_type()
    {
        return AccomodationType::where('status', 1)->orderby('orderby', 'asc')->get();
    }

    /**
     * Search image
     */
    public static function get_search_image()
    {
        $search_image = SearchImage::where('status', 1)->first();
        if ($search_image) {
            return $search_image;
        } else {
            return false;
        }

    }

    /**
     * Return country price according to ip address and return currency code
     * @return mixed
     */
    public static function ip_info()
    {
        $ip_data = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp'));

        $data['country'] = $ip_data->geoplugin_countryName;
        $data['countryCode'] = $ip_data->geoplugin_countryCode;
        if ($ip_data->geoplugin_countryCode == 'NP'){
            $data['price_adult'] = 'adult_npr';
            $data['currency'] = 'NPR';
        }elseif ($ip_data->geoplugin_countryCode == 'IN'){
            $data['price_adult'] = 'adult_inr';
            $data['currency'] = 'INR';
        }else{
            $data['price_adult'] = 'adult_usd';
            $data['currency'] = 'USD';
        }

        return $data;
    }

}
