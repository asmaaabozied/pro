<?php
/**
 * User controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 5 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\UserReferralDataTable;
use App\Http\Requests;
use App\Models\Country;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class UserReferraController extends CustomizedAppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->userRepository = $userRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
        Config::set('Title', trans('user.menu.usersReferral'));
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserReferralDataTable $UserReferralDataTable)
    {
        return $UserReferralDataTable->render('users_referral.index');
    }
    
}
