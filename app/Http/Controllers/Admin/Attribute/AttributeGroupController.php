<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\AttributeGroupAddRequest;
use App\Http\Requests\Attribute\AttributeGroupEditRequest;
use App\Models\Attribute\Attribute;
use App\Models\Language\Languages;
use App\Models\Attribute\AttributeGroup;
use App\Models\Attribute\AttributeGroupTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeGroupController extends Controller
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


        $attributesGroups = AttributeGroup::with(array('attributesGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->with('getAttributesCount')
            ->orderBy('sort', 'ASC')
            ->paginate(10);


        return view('admin.attribute.group.index', compact('attributesGroups'));
    }


    public function add(Request $request)
    {
        return view('admin.attribute.group.add');
    }

    public function store(AttributeGroupAddRequest $request)
    {


        $status = $request->status;
        $sort = $request->sort;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $attributeGroup = AttributeGroup::create([
            'status' => $status,
            'sort' => $sort,
        ]);


        foreach ($request->name as $key => $name):

            AttributeGroupTranslation::create([
                'name' => $name,
                'attribute_group_id' => $attributeGroup->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.attribute.group.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $attributeGroup = AttributeGroup::where('id', $id)
            ->with('attributesGroupsTranslations')->first();


        return view('admin.attribute.group.edit', compact('attributeGroup'));
    }

    public function update(AttributeGroupEditRequest $request)
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


        AttributeGroup::where('id', $id)
            ->update([
                'status' => $status,
                'sort' => $sort,

            ]);

        foreach ($request->name as $key => $name):
            AttributeGroupTranslation::where('attribute_group_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $attributeGroupTranslation = AttributeGroupTranslation::where('attribute_group_id', $id)
                ->where('language_id', $key)->first();

            if (!$attributeGroupTranslation) {
                AttributeGroupTranslation::create([
                    'name' => $name,
                    'attribute_group_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.attribute.group.index');


    }


    public function search(Request $request)
    {
        $search = $request->search;

        $attributesGroups = AttributeGroup::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('attributes_groups_translations', 'attributes_groups.id', '=', 'attributes_groups_translations.attribute_group_id')
            ->with('getAttributesCount')
            ->orderBy('sort', 'ASC')
            ->select(
                '*',
                'attributes_groups.updated_at as updated_at',
            )
            ->paginate(10);


        return view('admin.attribute.group.search', compact('attributesGroups'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $attribute = AttributeGroup::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($attribute) {
            $attribute->status = $statusActive;
            $attribute->save();

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
            $attribute = AttributeGroup::where('id', $id)->first();
            if ($attribute) {
                $attribute->sort = $sort;
                $attribute->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {


        $id = $request->id;
        $attributeGroup = Attribute::with(array('attributesGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->where('attribute_group_id', $id)
            ->first();

        $error = '';
        $name = '';
        if (is_null($attributeGroup)) {
            $error = null;
        } else {
            $name = $attributeGroup->attributesGroupsTranslations[0]->name;
        }


        return response()->json(['success' => true, 'error' => $error, 'name' => $name], 200);


    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        AttributeGroup::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDelete(Request $request)
    {

        $id = $request->IDs;

        AttributeGroup::whereIn('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {

        $ids = $request->IDs;

        $attrNameArr = [];
        $error = '';
        foreach ($ids as $id):
            $attributeGroup = Attribute::with(array('attributesGroupsTranslations' => function ($query) {
                $query->where('language_id', $this->defaultLanguage);

            }))
                ->where('attribute_group_id', $id)
                ->first();



            if ($attributeGroup != null) {
                $error = true;
                $attrNameArr['name'][] = $attributeGroup->attributesGroupsTranslations[0]->name;
            }else{
                $attrNameArr['id'][] = $id;
            }


        endforeach;


        return response()->json([
            'success' => true,
            'error' => $error,
            'ids' => $ids,
            'data' => $attrNameArr,
        ], 200);

    }


    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }


}
