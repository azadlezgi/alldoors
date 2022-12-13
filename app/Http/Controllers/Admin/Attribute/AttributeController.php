<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\AttributeAddRequest;
use App\Http\Requests\Attribute\AttributeEditRequest;
use App\Models\Attribute\AttributeGroup;
use App\Models\Language\Languages;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
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


        $attributes = Attribute::with(array('attributesTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->with(array('attributesGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->paginate(10);




        return view('admin.attribute.index', compact('attributes'));
    }

    public function list(Request $request)
    {
        $id = $request->id;

        $attributes = Attribute::with(array('attributesTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->where('attribute_group_id',$id)
            ->orderBy('sort', 'ASC')
            ->paginate(10);


        $attributeGroup = AttributeGroup::with(array('attributesGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('id', $id)
            ->first();




        return view('admin.attribute.list', compact('attributes','attributeGroup'));
    }


    public function add(Request $request)
    {

        $attributeGroups = AttributeGroup::with(array('attributesGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->get();


        return view('admin.attribute.add',compact('attributeGroups'));
    }

    public function store(AttributeAddRequest $request)
    {


        $status = $request->status;
        $sort = $request->sort;
        $attributeGroupID = $request->attribute_group_id;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $attribute = Attribute::create([
            'status' => $status,
            'attribute_group_id' => $attributeGroupID,
            'sort' => $sort,

        ]);


        foreach ($request->name as $key => $name):

            AttributeTranslation::create([
                'name' => $name,
                'attribute_id' => $attribute->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.attribute.index');


    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $attribute = Attribute::where('id', $id)
            ->with('attributesTranslations')->first();

        $attributeGroups = AttributeGroup::with(array('attributesGroupsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->get();



        return view('admin.attribute.edit', compact('attribute','attributeGroups'));
    }

    public function update(AttributeEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $sort = $request->sort;
        $attributeGroupID = $request->attribute_group_id;

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


        Attribute::where('id', $id)
            ->update([
                'status' => $status,
                'attribute_group_id' => $attributeGroupID,
                'sort' => $sort,
            ]);

        foreach ($request->name as $key => $name):
            AttributeTranslation::where('attribute_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $attributeTranslation = AttributeTranslation::where('attribute_id', $id)
                ->where('language_id', $key)->first();

            if(!$attributeTranslation){
                AttributeTranslation::create([
                    'name' => $name,
                    'attribute_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.attribute.index');


    }



    public function search(Request $request)
    {
        $search = $request->search;

        $attributes = Attribute::where('language_id', $this->defaultLanguage)
            ->with(array('attributesGroupsTranslations' => function ($query) {
                $query->where('language_id', $this->defaultLanguage);

            }))
            ->where('name', 'like', '%' . $search . '%')
            ->join('attributes_translations','attributes.id','=','attributes_translations.attribute_id')
            ->orderBy('sort', 'ASC')
            ->select(
                '*',
                'attributes.updated_at as updated_at',
            )
            ->paginate(10);





        return view('admin.attribute.search', compact('attributes'));
    }



    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $attribute = Attribute::where('id', $id)->first();
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
            $attribute = Attribute::where('id', $id)->first();
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
        Attribute::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        Attribute::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Attribute::where('id', $id)->delete();
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
