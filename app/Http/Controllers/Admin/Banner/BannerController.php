<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\BannerAddRequest;
use App\Http\Requests\Banner\BannerEditRequest;
use App\Models\Language\Languages;
use App\Models\Banner\Banner;
use App\Models\Banner\BannerTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BannerController extends Controller
{

    public $defaultLanguage;
    public $validatorCheck;


    public function __construct()
    {

        //Hansi dil defaultdursa onu caqir
        $this->defaultLanguage = cache('language-defaultID') == null ? Languages::where('default', 1)
            ->first()->id : cache('language-defaultID');

    }

    public function index(Request $request)
    {


        $banners = Banner::with(array('bannersTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->paginate(15);


        return view('admin.banner.index', compact('banners'));
    }

    public function add(Request $request)
    {
        return view('admin.banner.add');
    }

    public function store(BannerAddRequest $request)
    {


        $status = $request->status;
        $position = $request->position;

        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();

        $banner = Banner::create([
            'status' => $status,
            'position' => $position
        ]);

        foreach ($request->title as $key => $title):
            $bannerTranslation = BannerTranslation::create([
                'title' => $title,
                'sub_title' => $request->sub_title[$key],
                'button_name' => $request->button_name[$key],
                'button_url' => $request->button_url[$key],
                'image' => str_replace(env('APP_URL'), '', $request->image[$key]),
                'banner_id' => $banner->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.banner.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $banner = Banner::where('id', $id)
            ->with('bannersTranslations')->first();


        return view('admin.banner.edit', compact('banner'));
    }

    public function update(BannerEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $position = $request->position;

        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        //Eger gonderilen ID sehfdirse
        $refererError = CommonService::refererError($id);
        if ($refererError) {
            $this->validateCheck('refererID', 'Səhf ID istifadə etdiniz!');
        }


        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $banner = Banner::where('id', $id)
            ->update([
                'status' => $status,
                'position' => $position
            ]);

        foreach ($request->title as $key => $title):

            BannerTranslation::where('banner_id', $id)
                ->where('language_id', $key)
                ->update([
                    'title' => $title,
                    'sub_title' => $request->sub_title[$key],
                    'button_name' => $request->button_name[$key],
                    'button_url' => $request->button_url[$key],
                    'image' => str_replace(env('APP_URL'), '', $request->image[$key]),
                    'language_id' => $key,
                ]);

            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $bannerTranslation = BannerTranslation::where('banner_id', $id)
                ->where('language_id', $key)->first();

            if(!$bannerTranslation){
                BannerTranslation::create([
                    'title' => $title,
                    'sub_title' => $request->sub_title[$key],
                    'image' => str_replace(env('APP_URL'), '', $request->image[$key]),
                    'banner_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.banner.index');


    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $banner = Banner::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($banner) {
            $banner->status = $statusActive;
            $banner->save();

            if ($statusActive == 1) {
                $data = 1;
            } else {
                $data = 0;
            }

            $success = true;
        } else {
            $success = false;

        }


        return response()->json(['success' => $success, 'data' => $data]);
    }


    public function sortAjax(Request $request)
    {
        foreach ($request->positions as $item):
            $id = $item[0];
            $sort = $item[1];
            $language = Banner::where('id', $id)->first();
            if ($language) {
                $language->sort = $sort;
                $language->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Banner::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        Banner::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Banner::where('id', $id)->delete();
        endforeach;

        return response()->json(['success' => true], 200);

    }


    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }

}
