<?php
/**
 * User repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Jobs\SendEmailJob;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version May 5, 2020, 11:52 am UTC
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account_type',
        'store_account_type',
        'name',
        'email',
        'password',
        'image',
        'mobile',
        'country_id',
        'city_id',
        'address',
        'mobile_verified',
        'email_verified',
        'social_media',
        'activated',
        'status',
        'email_verified_at',
        'remember_token'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }


    /**
     * Find model record for given token
     *
     * @param string $token
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|User|null
     *
     * @author Amk El-Kabbany at 14 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function findByToken($token)
    {
        $query = $this->model->newQuery();
        $query->where('deleted_at', null)->where('remember_token', trim($token));

        return $query->first();
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $attribute
     * @return array
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($attribute = 'name')
    {
        return User::where('deleted_at', null)->where('account_type','!=',1)->where('name','!=','admin')->orderBy($attribute)->pluck($attribute, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return User
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        if(User::where('email', $input['email'])->exists() || User::where('mobile', $input['mobile'])->exists()) {
            Flash::error(trans('user.messages.exist_user'));
            return false;
        } else {
            if (request()->hasFile('image')) {
                $destinationPath = 'storage/Users/images';
                $file_info = getimagesize(request()->file('image'));
                if (empty($file_info)) { // No Image?
                    Flash::error(trans('common.messages.valid_image'));
                    return false;
                }
                $file = request()->file('image');
                $attach = $destinationPath . '/' . rand() . '-users-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, ($attach));
                $input['image'] = trim($attach);
            } else {
                $input['image'] = trim(asset('images/default-user.png'));
            }

            $roles = [];
            $permissions = [];
            if(isset($input['roles'])) {
                $roles = $input['roles'];
                unset($input['roles']);
            }
            if(isset($input['permissions'])) {
                $roles = $input['permissions'];
                unset($input['permissions']);
            }

            $user = new User();
            $input['password'] = bcrypt($input['password']);
            $user->fill($input)->save();

            foreach($roles as $role) {
                $user->assignRole($role);
            }
            foreach($permissions as $permission) {
                $user->givePermissionTo($permission);
            }

            return $user;
        }
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        unset($input['user_id']);
        if (User::where('id', '!=', $id)->where('email', $input['email'])->exists() || User::where('id', '!=', $id)->where('mobile', $input['mobile'])->exists()) {
            Flash::error(trans('user.messages.exist_user'));
            return false;
        } else {
            if (request()->hasFile('image')) {
                $destinationPath = 'storage/Users/images';
                $file_info = getimagesize(request()->file('image'));
                if (empty($file_info)) { // No Image?
                    Flash::error(trans('common.messages.valid_image'));
                    return false;
                }
                $file = request()->file('image');
                $attach = $destinationPath . '/' . rand() . '-users-' . date("d-m-y-H-M") . '-' . $file->getClientOriginalName();
                $file->move($destinationPath, ($attach));
                $input['image'] = trim($attach);
            }

            $roles = [];
            $permissions = [];
            if(isset($input['roles'])) {
                $roles = $input['roles'];
                unset($input['roles']);
            }
            if(isset($input['permissions'])) {
                $roles = $input['permissions'];
                unset($input['permissions']);
            }
            if(!empty($input['password'])){
                $input['password'] = bcrypt($input['password']);
            }else{
                unset($input['password']);
                unset($input['password_confirmation']);
            }

            $user = User::find($id);
            $user->fill($input)->save();

            foreach($roles as $role) {
                $user->assignRole($role);
            }
            foreach($permissions as $permission) {
                $user->givePermissionTo($permission);
            }

            return $user;
        }
    }

    /**
     * Log user in system
     *
     * @param Request $request
     * @param string  $login_type
     *
     * @return Authenticatable|boolean
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function login (Request $request, $login_type = 'system') {
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]) || Auth::attempt(['mobile' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();
            if($login_type == 'api' && $user->account_type != 4){
               Auth::logout();
               return false;
            }
            if(isset($request->firebase_token) && $request->firebase_token != null){
                $user->firebase_token = $request->firebase_token;
            }
            $token = $user->createToken('API')->accessToken;
            $user->setRememberToken($token);
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Log user in system
     *
     * @param Request $input
     *
     * @return Authenticatable|boolean
     *
     * @author Mahmoud Bakr at 17 August 2020
     * @contact m.bakr@upbeatdigital.team
     */
    public function social_login($input){
        $client = $this->model->where($input['social_login'] . '_id', $input[$input['social_login'] . '_id'])->where('social_login', $input['social_login'])->first();

        if($client) {
            
            if(isset($input['firebase_token']) && $input['firebase_token'] != null){
                $client->firebase_token = $input['firebase_token'];
                $client->save();
            }
            
        } else {
            if (request()->hasFile('image')) {
                $input['image'] = FileUpload::uploadFile('upload/Clients', request()->file('image'), '-clients-');
            }

            $input['account_type']      = 4;
            $input['social_medi']       = 1;
            $input['status']            = 'activated';
            $input['mobile_verified']   = 1;
    
            $client = new User();
            $client->fill($input)->save();
    
        }

        $token = $client->createToken('Laravel Personal Access Account')->accessToken;
        $client->setRememberToken($token);
        $client->save();

        return $client;
    }

    /**
     * Validate given token
     *
     * @param string  $token
     *
     * @return boolean|User
     *
     * @author Amk El-Kabbany at 8 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function validateToken ($token) {
        $user = $this->findByToken($token);
        if($user != null && Auth::id() == $user->id){
            return $user;
        };
        return false;
    }

    /**
     * Change user password
     *
     * @param Request $request
     *
     * @return boolean
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function changePassword (Request $request) {
        if(Hash::check($request->input('old_password'), Auth::user()->getAuthPassword())){
            $user = Auth::user();
            $user->password = bcrypt($request->input('new_password'));
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Forget user password
     *
     * @param Request $request
     *
     * @return boolean
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function forgetPassword (Request $request) {

        $user = User::where('email', $request->input('email'))->first();

        if($user){
            $new_password = bin2hex(random_bytes(5));
            $user->password = bcrypt($new_password);
            $user->save();

            dispatch_now(new SendEmailJob($user->email, trans('user.messages.new_password_subject'),
                            trans('user.messages.new_password_message').' '.$new_password,
                            ['From' => 'no-replay@upbeatdigital.team', 'X-Mailer' => 'PHP/' . phpversion()]));
            return true;
        }else{
            return false;
        }
    }

}
