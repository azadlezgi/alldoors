<?php

namespace App\Http\Controllers\Admin\Partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\PartnerAddRequest;
use App\Http\Requests\Partner\PartnerEditRequest;
use App\Models\Language\Languages;
use App\Models\Partner\Partner;
use App\Models\Partner\PartnerTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnersController extends Controller
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


        $partners = Partner::with(array('partnersTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->paginate(15);


        return view('admin.partner.index', compact('partners'));
    }

    public function add(Request $request)
    {
        return view('admin.partner.add');
    }

    public function store(PartnerAddRequest $request)
    {


        $status = $request->status;
        $image = $request->image;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $partner = Partner::create([
            'status' => $status,
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            PartnerTranslation::create([
                'name' => $name,
                'partner_id' => $partner->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.partner.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $partner = Partner::where('id', $id)
            ->with('partnersTranslations')->first();


        return view('admin.partner.edit', compact('partner'));
    }

    public function update(PartnerEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;

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


        $slide = Partner::where('id', $id)
            ->update([
                'status' => $status,
                'image' => str_replace(env('APP_URL'), '', $image),
            ]);

        foreach ($request->name as $key => $name):
             PartnerTranslation::where('partner_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $partnerTranslation = PartnerTranslation::where('partner_id', $id)
                ->where('language_id', $key)->first();

            if(!$partnerTranslation){
                PartnerTranslation::create([
                    'name' => $name,
                    'partner_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.partner.index');


    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $partner = Partner::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($partner) {
            $partner->status = $statusActive;
            $partner->save();

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
            $partner = Partner::where('id', $id)->first();
            if ($partner) {
                $partner->sort = $sort;
                $partner->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Partner::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        Partner::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }




    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Partner::where('id', $id)->delete();
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
