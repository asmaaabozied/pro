<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGift;
use App\Repositories\UserRepository;
use App\Core\Controllers\CustomizedAppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class UserGiftController extends CustomizedAppBaseController
{
    private $userRepository;
    protected $language;
    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->userRepository = $userRepo;
        // $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    public function store(Request $request)
    {
        $rules=[
            'title' => 'required|string',
            'description'=> 'required|string',
            'referral_count'=> 'required|int',
            'user_id' => 'required|exists:users,id|int',
        ];
        $input = $request->only('title','description','referral_count','user_id');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {//$validator->errors()->all()
            // return response()->json(['status' => 422, 'message' => $validator->errors()]);
            return $this->sendError(trans('common.no_data'));

        }
        $validator = Validator::make($input,$rules);

        if($validator->fails()){
            return $this->sendError(BaseAPI::handelValidationErrors($validator->errors()));
        }

        $usergift = UserGift::create($input);

        if (!$usergift) {
            return $this->sendError(BaseAPI::handelFlashErrors(trans('common.messages.errors.gift_created')));
        }
       //return $this->sendResponse($usergift, trans('common.messages.gift_created'));
       Flash::success(trans('common.messages.gift_created'));
       return back();
    }

    public function revokeGift($user_id, $gift_id)
    {
        $gift = UserGift::where( 'id' ,$gift_id)->where( 'user_id' , $user_id)->first();
        if(!empty($gift)){
            $gift->delete();
            Flash::success(trans('common.gift_revoked'));
            return redirect()->back();
        }
    }
}
