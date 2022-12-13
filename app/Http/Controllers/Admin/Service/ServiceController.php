<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceAddRequest;
use App\Http\Requests\Service\ServiceEditRequest;
use App\Models\Service\ServiceCategory;
use App\Models\Service\ServiceCategoryList;
use App\Models\Language\Languages;
use App\Models\Service\Service;
use App\Models\Service\ServiceTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
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

        $services = Service::with(array('servicesTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->with('servicesCategories')
            ->orderBy('sort', 'ASC')
            ->paginate(30);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.service.index', compact('services','defaultLanguage'));
    }

    public function categories(Request $request)
    {

        $id = $request->id;

        $services = Service::with(array('servicesTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('services_categories_lists.category_id',$id)
            ->join('services_categories_lists','services_categories_lists.service_id','=','services.id')
            ->orderBy('services.id', 'DESC')
            ->select('*','services.id as id')
            ->paginate(10);

        $category = ServiceCategory::where('language_id',  $this->defaultLanguage)
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
            ->where('id',$id)
            ->first();



        $defaultLanguage = $this->defaultLanguage;


        return view('admin.service.category', compact('services','defaultLanguage','category'));

    }

    public function add(Request $request)
    {

        $defaultLanguage = $this->defaultLanguage;

        return view('admin.service.add',compact('defaultLanguage'));
    }

    public function store(ServiceAddRequest $request)
    {

        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $categories = $request->categories;
        $images = str_replace(env('APP_URL'), '', $request->images);
        $images = json_encode($images, JSON_FORCE_OBJECT);

        if ($images == '""') {
            $images = trim($images, '""');
        }



        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $service = Service::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Service\Service'):uniqueSlug($slug,'\App\Models\Service\Service'),
            'image' => str_replace(env('APP_URL'), '', $image),
            'images' => $images,
        ]);

        foreach ($categories as $category):
            ServiceCategoryList::create([
               'service_id' => $service->id,
               'category_id' => $category
            ]);
        endforeach;


        foreach ($request->name as $key => $name):

            ServiceTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'service_id' => $service->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.service.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $service = Service::where('id', $id)
            ->with('servicesTranlations')
            ->with('servicesCategories')
            ->first();

        $defaultLanguage = $this->defaultLanguage;


        $selectCategories = [];
        foreach ($service->servicesCategories as $servicesCategory):
            $selectCategories[]= $servicesCategory->category_id;
        endforeach;



        return view('admin.service.edit', compact('service','defaultLanguage','selectCategories'));
    }

    public function update(ServiceEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $categories = $request->categories;
        $images = str_replace(env('APP_URL'), '', $request->images);
        $images = json_encode($images, JSON_FORCE_OBJECT);

        if ($images == '""') {
            $images = trim($images, '""');
        }

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


        $service = Service::where('id', $id)->first();
        if($service->slug != $slug){
            $service->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Service\Service'):uniqueSlug($slug,'\App\Models\Service\Service');
        }
        $service->status = $status;
        $service->image = str_replace(env('APP_URL'), '', $image);
        $service->images = $images;
        $service->updated_at = date('Y-m-d H:i:s');
        $service->save();


        //once sil sonra yeniden kateqoriyalari elave et
        ServiceCategoryList::where('service_id',$id)
            ->delete();

        foreach ($categories as $category):
            ServiceCategoryList::create([
                'service_id' => $service->id,
                'category_id' => $category
            ]);
        endforeach;



        foreach ($request->name as $key => $name):
            ServiceTranslation::where('service_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'language_id' => $key,
                ]);



            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $serviceTranslation = ServiceTranslation::where('service_id', $id)
                ->where('language_id', $key)->first();

            if(!$serviceTranslation){
                ServiceTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'service_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.service.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;

        $services = Service::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('services_translations','services.id','=','services_translations.service_id')
            ->orderBy('id', 'DESC')
            ->with('servicesCategories')
            ->select(
                '*',
                'services.updated_at as updated_at',
            )
            ->paginate(10);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.service.search', compact('services','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $service = Service::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($service) {
            $service->status = $statusActive;
            $service->save();

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
            $language = Service::where('id', $id)->first();
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
        Service::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        Service::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }

    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }
}
