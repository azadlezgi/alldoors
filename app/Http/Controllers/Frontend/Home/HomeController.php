<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slide\ContactSendRequest;
use App\Mail\Frontend\SendMail;
use App\Models\Page\Page;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Review\Review;
use App\Models\Service\Service;
use App\Models\Slide\Slide;
use App\Models\Team\Team;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{


    public function index(Request $request)
    {



        $slides = Slide::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('slides_translations', 'slides.id', '=', 'slides_translations.slide_id')
            ->orderBy('sort', 'ASC')
            ->get();



        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();



        $services = Service::with(array('servicesTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('servicesCategoriesCheck')
            ->join('services_categories_lists', 'services_categories_lists.service_id', '=', 'services.id')
            ->join('services_categories', function ($join) {
                $join->on('services_categories_lists.category_id', '=', 'services_categories.id')->where('services_categories.status', 1);
            })
            ->select(
                'services.id as id',
                'services.image as image',
                'services.images as images',
                'services.slug as slug',

                'services.status as status',
                'services.created_at as created_at',
                'services.updated_at as updated_at',
            )
            ->where('services.status', 1)
            ->groupBy('services_categories_lists.service_id')
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();


        $teams = Team::with(array('teamsTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->limit(4)
            ->get();


        $reviews = Review::with(array('reviewsTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->get();


        $posts = Post::with(array('postsTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('postsCategoriesCheck')
            ->join('posts_categories_lists', 'posts_categories_lists.post_id', '=', 'posts.id')
            ->join('posts_categories', function ($join) {
                $join->on('posts_categories_lists.category_id', '=', 'posts_categories.id')->where('posts_categories.status', 1);
            })
            ->select(
                'posts.id as id',
                'posts.image as image',
                'posts.images as images',
                'posts.slug as slug',

                'posts.status as status',
                'posts.created_at as created_at',
                'posts.updated_at as updated_at',
            )
            ->where('posts.status', 1)
            ->groupBy('posts_categories_lists.post_id')
            ->orderBy('id', 'DESC')
            ->limit(9)
            ->get();

        return view('frontend.home.index', compact(
            'slides',
            'partners',
            'services',
            'posts',
            'teams',
            'reviews',

        ));
    }


    public function contact(Request $request)
    {
        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();

        return view('frontend.home.contact',compact('partners'));
    }

    public function contactSendAjax(Request $request)
    {
        $name = $request->name;
        $subject = $request->subject;
        $email = $request->email;
        $mobil = $request->mobil;
        $text = $request->text;


        $data = [
            'name' => $name,
            'subject' => $subject,
            'email' => $email,
            'mobil' => $mobil,
            'text' => $text,
        ];

        $responseData = [];

        if (empty($data['name'])) {
            array_push($responseData, language('frontend.contact.form_error_name'));

        }

        if (empty($data['email'])) {
            array_push($responseData, language('frontend.contact.form_error_email'));
        } else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($responseData, language('frontend.contact.form_error_email_invalid'));
            }
        }


        if (empty($data['mobil'])) {
            array_push($responseData, language('frontend.contact.form_error_tel'));
        }

        if (empty($data['text'])) {
            array_push($responseData, language('frontend.contact.form_error_text'));
        }


        if (!empty($data['name']) && !empty($data['email']) && !empty($data['mobil']) && !empty($data['text']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $toMail = setting('email');


            Mail::to($toMail)
                ->send(new SendMail($data));

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true, 'data' => $responseData]);
        }


    }


    public function indexWelcome(Request $request)
    {
        return view('welcome');
    }


}
