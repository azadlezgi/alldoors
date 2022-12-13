<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Models\User;
use App\Services\CommonService;
use App\Services\Timezones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //Ozum yaratdim
    public $validatorCheck;

    public function index(Request $request)
    {


        $users = User::with('roles')
            ->orderBy('id', 'DESC')
            ->paginate(10);


        return view('admin.user.index', compact('users'));
    }


    public function add(Request $request)
    {
        //Super admin olmuyanlari getir
        $roles = Role::whereNotIn('id', [1])->get();

        return view('admin.user.add', compact('roles'));
    }

    public function store(UserRegisterRequest $request)
    {
        $username = $request->username;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $roles = $request->roles;
        $status = $request->status;


        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }


        if ($roles == 1) {
            $this->validateCheck('roles', 'Bu icazə sistemdə mövcud deyil.');
        }

        $this->validatorCheck->validate();
        //CUSTOM VALIDATE END


        $user = User::create([
            'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'status' => $status,
        ]);

        $user->syncRoles($roles);


        return redirect()->route('admin.user.index');
    }


    public function edit(Request $request)
    {
        $id = $request->id;

        $user = User::with('roles')
            ->where('id', $id)->first();


        if (!$user) {
            return redirect()->route('admin.user.index');
        }


        //Super admin olmuyanlari getir
        $roles = Role::whereNotIn('id', [1])->get();

        if ($user->hasRole(1)) {
            return redirect()->route('admin.user.index');
        }


        return view('admin.user.edit', compact('user', 'roles'));


    }


    public function update(Request $request)
    {
        $id = $request->id;
        $username = $request->username;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $roles = $request->roles;
        $status = $request->status;

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


        if ($roles == 1) {
            $this->validateCheck('roles', 'Bu icazə sistemdə mövcud deyil.');
        }

        $this->validatorCheck->validate();

        $customMessagesPassword = [];
        $customMessagesUsername = [];
        $rulesUSername = [];
        $rulesPassword = [];

        //Usernam validate unique
        $rulesUSername = [
            'roles' => 'required|exists:roles,id',
            'username' => 'required|unique:users,username,' . $id . '|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|min:3|max:255',
            'name' => 'required',
        ];

        $customMessagesUsername = [
            /*   ROLES   */
            'roles.required' => 'İcazə mütləqdir.',
            'roles.exists' => 'Bu icazə sistemdə mövcud deyil.',

            /*   e-mail   */
            'email.required' => 'E-mail mütləqdir.',
            'email.unique' => $email . ' adlı e-mail adresi sistemdə mövcuddur, zəhmət olmasa başqa e-mail adresi yoxlayın.',
            'email.email' => 'Doğru e-mail formatı istifadə edin.',
            'email.min' => 'E-mail minimum 3 simvol olmalıdır.',
            'email.max' => 'E-mail maximum 255 simvol olmalıdır.',

            /*   username   */
            'username.required' => 'İstifadəçi adı mütləqdir.',
            'username.unique' => $username . ' adlı istifadəçi sistemdə mövcuddur, zəhmət olmasa başqa istifadəçi adı yoxlayın.',
            'username.min' => 'İstifadəçi adı minimum 3 simvol olmalıdır.',
            'username.max' => 'İstifadəçi ad maximum 255 simvol olmalıdır.',

            /*   name   */
            'name.required' => 'Ad soyad mütləqdir.',

        ];

        //Password Check
        if (!empty($password)) {
            $rulesPassword = [
                'password' => 'min:8|max:50',
                'password_confirmation' => 'same:password'
            ];

            $customMessagesPassword = [
                /*  password   */
                'password.min' => 'Şifre minimum 8 simvol olmalıdır.',
                'password.max' => 'Şifre maximum 50 simvol olmalıdır.',

                /*  password_confirmation   */
                'password_confirmation.required' => 'Təkrar şifrə mütləqdir.',
                'password_confirmation.same' => 'Təkrar şifrə yalnışdır',
            ];


        }

        $rules = array_merge($rulesPassword, $rulesUSername);
        $customMessages = array_merge($customMessagesPassword, $customMessagesUsername);


        $request->validate($rules, $customMessages);
        //CUSTOM VALIDATE END


        $user = User::where('id', $id)->first();
        $user->username = $username;
        $user->name = $name;
        $user->email = $email;
        $user->status = $status;
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->save();

        $user->removeRole($roles);
        $user->syncRoles($roles);

        return redirect()->route('admin.user.index');

    }


    public function profilEdit(Request $request)
    {
        $id = $request->id;

        $user = User::where('id', $id)->first();


        if ($id != Auth::id()) {
            return redirect()->route('admin.index');
        }


        return view('admin.user.profil.edit', compact('user'));

    }


    public function profilUpdate(Request $request)
    {
        $id = $request->id;
        $username = $request->username;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        //Eger gonderilen ID sehfdirse
        $refererError = CommonService::refererError($id);
        if ($refererError) {
            $this->validateCheck('refererID', 'Səhf ID istifadə etdiniz!');

        }


        //foto format check
        $image_64 = $request->profile_photo_upload; //your base64 encoded data
        if (!empty($image_64)) {
            if (!is_base64($image_64)) {
                $this->validateCheck('profile_photo', 'Sehf foto formatı.İcazə verilən formatlar (jpg,jpeg və png)');
            }

        }

        //Foto Legv olunmushsa
        if($request->not_photo == '1'){

                $user = User::where('id', Auth::id())
                    ->first();

                if (!empty($user->profile_photo)) {
                    Storage::delete('public/profile/' . $user->profile_photo);
                }
                $user->profile_photo = '';
                $user->save();

        }


        $this->validatorCheck->validate();


        $customMessagesPassword = [];
        $customMessagesUsername = [];
        $rulesUSername = [];
        $rulesPassword = [];

        //Usernam validate unique
        $rulesUSername = [
            'username' => 'required|unique:users,username,' . $id . '|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|min:3|max:255',
            'name' => 'required',
            'profile_photo' => 'mimes:jpg,png',
        ];

        $customMessagesUsername = [

            /*   profile_photo   */
            'profile_photo.mimes' => 'Siz foto üçün səhv şəkil formatı seçdiniz.İcazə verilən formatlar (jpg,jpeg,png)',

            /*   e-mail   */
            'email.required' => 'E-mail mütləqdir.',
            'email.unique' => $email . ' adlı e-mail adresi sistemdə mövcuddur, zəhmət olmasa başqa e-mail adresi yoxlayın.',
            'email.email' => 'Doğru e-mail formatı istifadə edin.',
            'email.min' => 'E-mail minimum 3 simvol olmalıdır.',
            'email.max' => 'E-mail maximum 255 simvol olmalıdır.',

            /*   username   */
            'username.required' => 'İstifadəçi adı mütləqdir.',
            'username.unique' => $username . ' adlı istifadəçi sistemdə mövcuddur, zəhmət olmasa başqa istifadəçi adı yoxlayın.',
            'username.min' => 'İstifadəçi adı minimum 3 simvol olmalıdır.',
            'username.max' => 'İstifadəçi ad maximum 255 simvol olmalıdır.',

            /*   name   */
            'name.required' => 'Ad soyad mütləqdir.',

        ];

        //Password Check
        if (!empty($password)) {
            $rulesPassword = [
                'password' => 'min:8|max:50',
                'password_confirmation' => 'same:password'
            ];

            $customMessagesPassword = [
                /*  password   */
                'password.min' => 'Şifre minimum 8 simvol olmalıdır.',
                'password.max' => 'Şifre maximum 50 simvol olmalıdır.',

                /*  password_confirmation   */
                'password_confirmation.required' => 'Təkrar şifrə mütləqdir.',
                'password_confirmation.same' => 'Təkrar şifrə yalnışdır',
            ];


        }

        $rules = array_merge($rulesPassword, $rulesUSername);
        $customMessages = array_merge($customMessagesPassword, $customMessagesUsername);


        $request->validate($rules, $customMessages);
        //CUSTOM VALIDATE END


        //profile_photo
        if ($request->hasFile('profile_photo')) {

            $user = User::where('id', Auth::id())
                ->first();

            if (!empty($user->profile_photo)) {
                Storage::delete('public/profile/' . $user->profile_photo);
            }


            $image_64 = $request->profile_photo_upload; //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);


            $manufacturerpath = "public/profile";
            $imageName = Auth::id() . '-' . Str::random(20) . '.jpg';
            Storage::put($manufacturerpath . '/' . $imageName, base64_decode($image));


            //foto yuklendikden sonra compres et
            $manufacturerPathStorage = "storage/profile";
            compressImgFile($manufacturerPathStorage . '/' . $imageName, $manufacturerPathStorage . '/' . $imageName, 80);


            //bazaya yaz
            $user->profile_photo = $imageName;
            $user->save();


        }


        $user = User::where('id', $id)->first();
        $user->username = $username;
        $user->name = $name;
        $user->email = $email;
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->save();


        return redirect()->back();

    }


    public function search(Request $request)
    {
        $search = $request->search;


        $users = User::with('roles')
            ->where(function ($query) use ($search) {
                $query->orWhere('users.name', 'like', '%' . $search . '%');
                $query->orWhere('users.username', 'like', '%' . $search . '%');
                $query->orWhere('users.email', 'like', '%' . $search . '%');
            })->orderby('id', 'DESC')
            ->paginate(10);


        return view('admin.user.index', compact('users', 'search'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $user = User::with('roles')
            ->where('id', $id)->first();

        if ($user->roles[0]->id != 1) {


            $data = '';
            $success = '';

            if ($user) {
                $user->status = $statusActive;
                $user->save();

                if ($statusActive == 1) {
                    $data = 1;
                } else {
                    $data = 0;
                }

                $success = true;
            } else {
                $success = false;

            }
        } else {
            $success = false;
            return response()->json(['success' => $success]);
        }

        return response()->json(['success' => $success, 'data' => $data]);
    }


    public function deleteAjax(Request $request)
    {
        $id = $request->id;

        $user = User::where('id', $id)
            ->first();

        if ($user->hasRole(1)) {
            return response()->json(['checkAdmin' => true, 'name' => $user->name], 200);
        } else {
            return response()->json(['success' => true, 'name' => $user->name], 200);
        }


    }

    public function delete(Request $request)
    {

        //istifadecinin ozunu silir
        $id = intval($request->id);

        //Eger BU id admindirse silme
        $user = User::where('id', $id)
            ->first();
        if ($user->hasRole(1)) {
            return response()->json(['checkAdmin' => true, 'name' => $user->name], 200);
        }


        User::where('id', $id)->delete();

        //bu id li userin roleni silir
        DB::delete("DELETE FROM model_has_roles WHERE model_id = " . $id);

        return response()->json(['success' => true], 200);


    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            User::where('id', $id)->delete();

            //bu id li userin roleni silir
            DB::delete("DELETE FROM model_has_roles WHERE model_id = " . $id);
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
