<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Option\OptionGroupAddRequest;
use App\Http\Requests\Option\OptionGroupEditRequest;
use App\Models\Option\Option;
use App\Models\Language\Languages;
use App\Models\Option\OptionGroup;
use App\Models\Option\OptionGroupTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionGroupController extends Controller
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


        $optionsGroups = OptionGroup::with(array('optionsGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->with('getOptionsCount')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);





        return view('admin.option.group.index', compact('optionsGroups'));
    }



    public function add(Request $request)
    {
        return view('admin.option.group.add');
    }

    public function store(OptionGroupAddRequest $request)
    {


        $status = $request->status;
        $sort = $request->sort;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $optionGroup = OptionGroup::create([
            'status' => $status,
            'sort' => $sort,
        ]);


        foreach ($request->name as $key => $name):

            OptionGroupTranslation::create([
                'name' => $name,
                'option_group_id' => $optionGroup->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.option.group.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $optionGroup = OptionGroup::where('id', $id)
            ->with('optionsGroupsTranslations')->first();


        return view('admin.option.group.edit', compact('optionGroup'));
    }

    public function update(OptionGroupEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $sort = $request->sort;

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


        OptionGroup::where('id', $id)
            ->update([
                'status' => $status,
                'sort' => $sort,

            ]);

        foreach ($request->name as $key => $name):
            OptionGroupTranslation::where('option_group_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $optionGroupTranslation = OptionGroupTranslation::where('option_group_id', $id)
                ->where('language_id', $key)->first();

            if(!$optionGroupTranslation){
                OptionGroupTranslation::create([
                    'name' => $name,
                    'option_group_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.option.group.index');


    }


    public function search(Request $request)
    {
        $search = $request->search;

        $optionsGroups = OptionGroup::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('options_groups_translations','options_groups.id','=','options_groups_translations.option_group_id')
            ->with('getOptionsCount')
            ->orderBy('sort', 'ASC')
            ->select(
                '*',
                'options_groups.updated_at as updated_at',
            )
            ->paginate(10);





        return view('admin.option.group.search', compact('optionsGroups'));
    }



    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $option = OptionGroup::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($option) {
            $option->status = $statusActive;
            $option->save();

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
            $option = OptionGroup::where('id', $id)->first();
            if ($option) {
                $option->sort = $sort;
                $option->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {
//        $id = $request->id;
//        OptionGroup::where('id', $id)
//            ->first();

//        return response()->json(['success' => true], 200);



        $id = $request->id;
        $optionGroup = Option::with(array('optionsGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->where('option_group_id', $id)
            ->first();

        $error = '';
        $name = '';
        if(is_null($optionGroup)){
            $error = null;
        }else{
            $name = $optionGroup->optionsGroupsTranslations[0]->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);


    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        OptionGroup::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }



    public function allDelete(Request $request)
    {

        $id = $request->IDs;

        OptionGroup::whereIn('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {

        $ids = $request->IDs;

        $optionNameArr = [];
        $error = '';
        foreach ($ids as $id):
            $optionGroup = Option::with(array('optionsGroupsTranslations' => function ($query) {
                $query->where('language_id', $this->defaultLanguage);

            }))
                ->where('option_group_id', $id)
                ->first();



            if ($optionGroup != null) {
                $error = true;
                $optionNameArr['name'][] = $optionGroup->optionsGroupsTranslations[0]->name;
            }else{
                $optionNameArr['id'][] = $id;
            }


        endforeach;


        return response()->json([
            'success' => true,
            'error' => $error,
            'ids' => $ids,
            'data' => $optionNameArr,
        ], 200);

    }



    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }


}
