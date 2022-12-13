<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\ReviewAddRequest;
use App\Http\Requests\Review\ReviewEditRequest;
use App\Models\Language\Languages;
use App\Models\Review\Review;
use App\Models\Review\ReviewTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
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


        $reviews = Review::with(array('reviewsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->paginate(30);


        return view('admin.review.index', compact('reviews'));
    }

    public function add(Request $request)
    {
        return view('admin.review.add');
    }

    public function store(ReviewAddRequest $request)
    {


        $status = $request->status;
        $image = $request->image;
        $position = $request->position;
        $text = $request->text;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $review = Review::create([
            'status' => $status,
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            ReviewTranslation::create([
                'name' => $name,
                'position' => $position[$key],
                'text' => $text[$key],
                'review_id' => $review->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.review.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $review = Review::where('id', $id)
            ->with('reviewsTranslations')->first();


        return view('admin.review.edit', compact('review'));
    }

    public function update(ReviewEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $position = $request->position;
        $text = $request->text;

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


        $slide = Review::where('id', $id)
            ->update([
                'status' => $status,
                'image' => str_replace(env('APP_URL'), '', $image),
            ]);

        foreach ($request->name as $key => $name):
             ReviewTranslation::where('review_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'position' => $position[$key],
                    'text' => $text[$key],
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $reviewTranslation = ReviewTranslation::where('review_id', $id)
                ->where('language_id', $key)->first();

            if(!$reviewTranslation){
                ReviewTranslation::create([
                    'name' => $name,
                    'position' => $position[$key],
                    'text' => $text[$key],
                    'review_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.review.index');


    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $review = Review::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($review) {
            $review->status = $statusActive;
            $review->save();

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
            $review = Review::where('id', $id)->first();
            if ($review) {
                $review->sort = $sort;
                $review->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Review::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        Review::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }



    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Review::where('id', $id)->delete();
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
