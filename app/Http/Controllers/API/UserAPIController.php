<?php
/**
 * User API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Core\Controllers\APIs\BaseAPI;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\UserResource;
use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 11 May 2020
 * @contact alaa@upbeatdigital.team
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Log user in system.
     * POST /login
     *
     * @param Request $request
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), ($request->input('social_media') == 0) ? User::$loginRules : User::$socialLoginRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $user = $this->userRepository->login($request, 'api');

        if($user) {
            return $this->sendResponse(UserResource::toArray($user, $this->language, true), trans('user.messages.logged_in'));
        } else {
            return $this->sendError(trans('user.messages.errors.logged_in'));
        }
    }

    /**
     * Log user in system with social account.
     * POST /socia_login
     *
     * @param Request $request
     *
     * @return Response
     *
     * @author Mahmoud Bakr at 17 August 2020
     * @contact m.bakr@upbeatdigital.team
     */
    public function social_login(Request $request){
        $input = $request->all();

        $clients = $this->userRepository->social_login($input);

        // dd($clients);
        if($clients) {
            return $this->sendResponse(UserResource::toArray($clients, $this->language, true), trans('user.messages.logged_in'));
        } else {
            return $this->sendError(trans('user.messages.errors.logged_in'));
        }
    }

    /**
     * Validate given token
     * GET /validate-token
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 8 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function validateToken () {
        $user = $this->userRepository->validateToken(request()->bearerToken());
        if(! empty($user) && $user instanceof User){
            return $this->sendResponse(UserResource::toArray($user, $this->language, true), trans('user.messages.retrieved'));
        }
        return $this->sendError(trans('user.messages.errors.login'));
    }

    /**
     * Log user out system.
     * GET /logout
     *
     * @return Response
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function logout () {
        Auth::user()->token()->revoke();
        return $this->sendResponse(true, trans('user.messages.logged_out'));
    }

    /**
     * Change user password.
     * POST /users/change-password
     *
     * @param Request $request
     * @return Response
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function changePassword (Request $request) {
        $validator = Validator::make($request->all(), User::$changePasswordRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $flag = $this->userRepository->changePassword($request);

        if($flag){
            return $this->sendResponse(true, trans('user.messages.password_changed'));
        } else {
            return $this->sendError(trans('user.messages.errors.password_changed'));
        }
    }

    /**
     * Forget user password.
     * POST /users/forget-password
     *
     * @param Request $request
     * @return Response
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function forgetPassword (Request $request) {

        $validator = Validator::make($request->all(), User::$forgetPasswordRules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $flag = $this->userRepository->forgetPassword($request);

        if($flag){
            return $this->sendResponse(true, trans('user.messages.forget_password'));
        } else {
            return $this->sendError(trans('user.messages.errors.forget_password'));
        }
    }

    /**
     * Retrieve a pluck of the Brand.
     * GET|HEAD /brands
     *
     * @param string $attribute
     * @return Response
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function pluck($attribute = 'name')
    {
        $users = $this->userRepository->pluck($attribute);
        return $this->sendResponse($users, trans('user.messages.retrieved'));
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param Request $request
     *
     * @return Response
     */
    public function clientRegistration(Request $request)
    {
        $user_code= mt_rand(1000, 9999);
        $input = $request->all();
        $input['account_type'] = 4;
        $input['status'] = 'activated';
        $input['mobile_verified'] = 1;
    
        
        $validator = Validator::make($input, User::$rules);
        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }
        
        //check if refaller is okay
        if(!empty($input['referral_code'])){
            $referral_user=User::where('user_code',$input['referral_code'])->first();
            if(empty($referral_user)){
                return $this->sendError(trans('user.messages.errors.referral_code'));
            }
        }


        $user = $this->userRepository->create($input);

        if (! $user) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('user.messages.errors.created')));
        }

        $token = $user->createToken('API Client')->accessToken;
        $user->setRememberToken($token);
        $user->user_code=$user->id.$user_code;
        $user->save();
        return $this->sendResponse(UserResource::toArray($user, $this->language, true), trans('user.messages.created'));
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param Request $request
     *
     * @return Response
     */
    public function storeOwnerRegistration(Request $request)
    {
        $input = $request->all();
        $input['account_type'] = 3;
        $input['store_account_type'] = $input['type'];
        $input['status'] = 'pending';
        $input['mobile_verified'] = 1;
        unset($input['type']);

        $validator = Validator::make($input, User::$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $user = $this->userRepository->create($input);

        if (! $user) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('user.messages.errors.created')));
        }

        $token = $user->createToken('API Store Owner')->accessToken;
        $user->setRememberToken($token);
        $user->save();
        return $this->sendResponse(UserResource::toArray($user, $this->language, true), trans('user.messages.created'));
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError(trans('user.messages.not_found'));
        }

        return $this->sendResponse(UserResource::toArray($user, $this->language), trans('user.messages.retrieved'));
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @return Response
     */
    public function showByToken()
    {
        /** @var User $user */
        $user = $this->userRepository->findByToken(request()->bearerToken());

        if (empty($user)) {
            return $this->sendError(trans('user.messages.not_found'));
        }

        return $this->sendResponse(UserResource::toArray($user, $this->language), trans('user.messages.retrieved'));
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $this->userRepository->findByToken(request()->bearerToken())->id;

        $input = UserResource::casts($request->all(), $id);

        $rules = User::$rules;
        unset($rules['password']);

        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError(trans('user.messages.not_found'));
        }

        $user = $this->userRepository->update($input, $id);

        if (! $user) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('user.messages.errors.updated')));
        }

        return $this->sendResponse(UserResource::toArray($user, $this->language), trans('user.messages.updated'));
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError(trans('user.messages.not_found'));
        }

        $user->delete();

        return $this->sendSuccess(trans('user.messages.deleted'));
    }
}
