<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\TeamAddRequest;
use App\Http\Requests\Team\TeamEditRequest;
use App\Models\Language\Languages;
use App\Models\Team\Team;
use App\Models\Team\TeamTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
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


        $teams = Team::with(array('teamsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->orderBy('sort', 'ASC')
            ->paginate(15);


        return view('admin.team.index', compact('teams'));
    }

    public function add(Request $request)
    {
        return view('admin.team.add');
    }

    public function store(TeamAddRequest $request)
    {


        $status = $request->status;
        $position = $request->position;
        $social = $request->social;
        $image = $request->image;
        $slug = $request->slug;




        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $team = Team::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Team\Team'):uniqueSlug($slug,'\App\Models\Team\Team'),
            'social' => json_encode(array_values($social), JSON_UNESCAPED_UNICODE),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            TeamTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'position' => $position[$key],
                'team_id' => $team->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.team.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $team = Team::where('id', $id)
            ->with('teamsTranslations')->first();


        return view('admin.team.edit', compact('team'));
    }

    public function update(TeamEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $position = $request->position;
        $social = $request->social;
        $image = $request->image;
        $slug = $request->slug;

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




        $team = Team::where('id', $id)->first();
        if($team->slug != $slug){
            $team->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Team\Team'):uniqueSlug($slug,'\App\Models\Team\Team');
        }
        $team->status = $status;
        $team->social = json_encode(array_values($social), JSON_UNESCAPED_UNICODE);
        $team->image = str_replace(env('APP_URL'), '', $image);
        $team->updated_at = date('Y-m-d H:i:s');
        $team->save();

        foreach ($request->name as $key => $name):
             TeamTranslation::where('team_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'position' => $position[$key],
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $teamTranslation = TeamTranslation::where('team_id', $id)
                ->where('language_id', $key)->first();

            if(!$teamTranslation){
                TeamTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'position' => $position[$key],
                    'team_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.team.index');


    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $team = Team::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($team) {
            $team->status = $statusActive;
            $team->save();

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
            $team = Team::where('id', $id)->first();
            if ($team) {
                $team->sort = $sort;
                $team->save();
            }

        endforeach;


        return response()->json(['success' => true]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Team::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }


    public function delete(Request $request)
    {

        $id = intval($request->id);

        Team::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Team::where('id', $id)->delete();
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
