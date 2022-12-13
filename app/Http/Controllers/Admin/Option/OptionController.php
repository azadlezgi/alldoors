<?php

namespace App\Http\Controllers\Admin\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Option\OptionAddRequest;
use App\Http\Requests\Option\OptionEditRequest;
use App\Models\Option\OptionGroup;
use App\Models\Language\Languages;
use App\Models\Option\Option;
use App\Models\Option\OptionTranslation;
use App\Models\Option\OptionValue;
use App\Models\Option\OptionValueTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
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


        $options = Option::with(array('optionsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->with(array('optionsGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('created_at', 'DESC')
            ->paginate(10);


        return view('admin.option.index', compact('options'));
    }

    public function list(Request $request)
    {
        $id = $request->id;

        $options = Option::with(array('optionsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->where('option_group_id',$id)
            ->orderBy('sort', 'ASC')
            ->paginate(10);


        $optionGroup = OptionGroup::with(array('optionsGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('id', $id)
            ->first();


        return view('admin.option.list', compact('options', 'optionGroup'));
    }

    public function add(Request $request)
    {

        $optionGroups = OptionGroup::with(array('optionsGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->get();


        return view('admin.option.add', compact('optionGroups'));
    }

    public function store(OptionAddRequest $request)
    {


        $status = $request->status;
        $sort = $request->sort;
        $type = $request->type;
        $optionGroupID = $request->option_group_id;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }


        if ($type != 1 && $type != 2) {
            $this->validateCheck('type', 'Səhv tip.');
        }

        if ($request->option_list == null) {
            if ($type == 1 || $type == 2) {
                $this->validateCheck('type', 'Seçim seçilməyib.');
            }
        }


        $this->validatorCheck->validate();


        //Option STORE
        $option = Option::create([
            'status' => $status,
            'option_group_id' => $optionGroupID,
            'type' => $type,
            'sort' => $sort,

        ]);

        //Option Translation STORE
        foreach ($request->name as $key => $name):

            OptionTranslation::create([
                'name' => $name,
                'option_id' => $option->id,
                'language_id' => $key,
            ]);

        endforeach;


        //OPTION VALUES IMAGE AND TEXT
        if ($type == 1) {

            foreach ($request->option_list['sort'] as $optionSortKey => $optionSortValue):
                $optionValue = OptionValue::create([
                    'option_id' => $option->id,
                    'sort' => $optionSortValue == null ? 0 : $optionSortValue,
                    'image' => str_replace(env('APP_URL'), '', $request->option_list['image'][$optionSortKey]),
                ]);


                foreach (array_values($request->option_list['language_id'])[$optionSortKey] as $optionLanguageIDKey => $optionLanguageIDValue):

                    OptionValueTranslation::create([
                        'option_value_id' => $optionValue->id,
                        'language_id' => $optionLanguageIDValue,
                        'text' => array_values($request->option_list['language'])[$optionSortKey][$optionLanguageIDKey],
                    ]);

                endforeach;


            endforeach;
        } //OPTION VALUES IMAGE AND END




        //OPTION VALUES TEXT START
        if ($type == 2) {

            foreach ($request->option_list['sort'] as $optionSortKey => $optionSortValue):
                $optionValue = OptionValue::create([
                    'option_id' => $option->id,
                    'sort' => $optionSortValue == null ? 0 : $optionSortValue,
                    'image' => '',
                ]);


                foreach (array_values($request->option_list['language_id'])[$optionSortKey] as $optionLanguageIDKey => $optionLanguageIDValue):

                    OptionValueTranslation::create([
                        'option_value_id' => $optionValue->id,
                        'language_id' => $optionLanguageIDValue,
                        'text' => array_values($request->option_list['language'])[$optionSortKey][$optionLanguageIDKey],
                    ]);

                endforeach;


            endforeach;
        }//OPTION VALUES TEXT END




        return redirect()->route('admin.option.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $option = Option::where('id', $id)
            ->with('optionsTranslations')->first();

        $optionGroups = OptionGroup::with(array('optionsGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->get();


        $optionValue = OptionValue::with('optionsValuesTranslations')
            ->where('option_id', $id)
            ->get();


        return view('admin.option.edit', compact('option', 'optionGroups', 'optionValue'));
    }

    public function update(OptionEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $sort = $request->sort;
        $type = $request->type;
        $optionGroupID = $request->option_group_id;

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

        if ($type != 1 && $type != 2) {
            $this->validateCheck('type', 'Səhv tip.');
        }

        if ($request->option_list == null) {
            if ($type == 1 || $type == 2) {
                $this->validateCheck('type', 'Seçim seçilməyib.');
            }
        }

        $this->validatorCheck->validate();


        Option::where('id', $id)
            ->update([
                'status' => $status,
                'type' => $type,
                'option_group_id' => $optionGroupID,
                'sort' => $sort,
            ]);

        foreach ($request->name as $key => $name):
            OptionTranslation::where('option_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $optionTranslation = OptionTranslation::where('option_id', $id)
                ->where('language_id', $key)->first();

            if (!$optionTranslation) {
                OptionTranslation::create([
                    'name' => $name,
                    'option_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;


        //OPTION VALUES IMAGE AND TEXT START
        if ($type == 1) {


            //OPTIONS DELETED
            OptionValue::where('option_id', $id)->delete();

            //AFTER CREATE

            foreach ($request->option_list['sort'] as $optionSortKey => $optionSortValue):
                $optionValue = OptionValue::create([
                    'option_id' => $id,
                    'sort' => $optionSortValue == null ? 0 : $optionSortValue,
                    'image' => str_replace(env('APP_URL'), '', $request->option_list['image'][$optionSortKey]),
                ]);


                foreach (array_values($request->option_list['language_id'])[$optionSortKey] as $optionLanguageIDKey => $optionLanguageIDValue):

                    OptionValueTranslation::create([
                        'option_value_id' => $optionValue->id,
                        'language_id' => $optionLanguageIDValue,
                        'text' => array_values($request->option_list['language'])[$optionSortKey][$optionLanguageIDKey],
                    ]);

                endforeach;


            endforeach;
        }   //OPTION VALUES IMAGE AND TEXT END



        //OPTION VALUES IMAGE AND TEXT START
        if ($type == 2) {


            //OPTIONS DELETED
            OptionValue::where('option_id', $id)->delete();

            //AFTER CREATE

            foreach ($request->option_list['sort'] as $optionSortKey => $optionSortValue):
                $optionValue = OptionValue::create([
                    'option_id' => $id,
                    'sort' => $optionSortValue == null ? 0 : $optionSortValue,
                    'image' => '',
                ]);


                foreach (array_values($request->option_list['language_id'])[$optionSortKey] as $optionLanguageIDKey => $optionLanguageIDValue):

                    OptionValueTranslation::create([
                        'option_value_id' => $optionValue->id,
                        'language_id' => $optionLanguageIDValue,
                        'text' => array_values($request->option_list['language'])[$optionSortKey][$optionLanguageIDKey],
                    ]);

                endforeach;


            endforeach;
        }   //OPTION VALUES IMAGE AND TEXT END


        return redirect()->route('admin.option.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;

        $options = Option::where('language_id', $this->defaultLanguage)
            ->with(array('optionsGroupsTranslations' => function ($query) {
                $query->where('language_id', $this->defaultLanguage);

            }))
            ->where('name', 'like', '%' . $search . '%')
            ->join('options_translations', 'options.id', '=', 'options_translations.option_id')
            ->orderBy('sort', 'ASC')
            ->select(
                '*',
                'options.updated_at as updated_at',
            )
            ->paginate(10);


        return view('admin.option.search', compact('options'));
    }

    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $option = Option::where('id', $id)->first();
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
            $option = Option::where('id', $id)->first();
            if ($option) {
                $option->sort = $sort;
                $option->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function getOptionAddAjax(Request $request)
    {

        $optionsAdd = view('admin.option.option-add.add-option')->render();

        return response()->json(['success' => true, 'options' => $optionsAdd], 200);

    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Option::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        Option::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Option::where('id', $id)->delete();
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
