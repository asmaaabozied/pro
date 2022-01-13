<?php
/**
 * Social Media Link controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\DataTables\SocialMediaLinkDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSocialMediaLinkRequest;
use App\Http\Requests\UpdateSocialMediaLinkRequest;
use App\Repositories\SocialMediaLinkRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class SocialMediaLinkController extends CustomizedAppBaseController 
{
    /** @var  SocialMediaLinkRepository */
    private $socialMediaLinkRepository;

    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct(SocialMediaLinkRepository $socialMediaLinkRepo)
    {
        parent::__construct();
        $this->socialMediaLinkRepository = $socialMediaLinkRepo;
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Seed main data into categories table.
     *
     * @return Response
     */
    public function seed()
    {
        $seeder = new \SocialMediaSeeder();
        $seeder->run();
        return redirect()->back();
    }

    /**
     * Display a listing of the SocialMediaLink.
     *
     * @param SocialMediaLinkDataTable $socialMediaLinkDataTable
     * @return Response
     */
    public function index(SocialMediaLinkDataTable $socialMediaLinkDataTable)
    {
        return $socialMediaLinkDataTable->render('socialMediaLinks.index');
    }

    /**
     * Show the form for creating a new SocialMediaLink.
     *
     * @return Response
     */
    public function create()
    {
        return view('socialMediaLinks.create');
    }

    /**
     * Store a newly created SocialMediaLink in storage.
     *
     * @param CreateSocialMediaLinkRequest $request
     *
     * @return Response
     */
    public function store(CreateSocialMediaLinkRequest $request)
    {
        $input = $request->all();

        $socialMediaLink = $this->socialMediaLinkRepository->create($input);

        Flash::success(trans('socialMediaLink.messages.created'));

        return redirect(route('socialMediaLinks.index'));
    }

    /**
     * Display the specified SocialMediaLink.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $socialMediaLink = $this->socialMediaLinkRepository->find($id);

        if (empty($socialMediaLink)) {
            Flash::error(trans('socialMediaLink.messages.not_found'));

            return redirect(route('socialMediaLinks.index'));
        }

        return view('socialMediaLinks.show')->with('socialMediaLink', $socialMediaLink);
    }

    /**
     * Show the form for editing the specified SocialMediaLink.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $socialMediaLink = $this->socialMediaLinkRepository->find($id);

        if (empty($socialMediaLink)) {
            Flash::error(trans('socialMediaLink.messages.not_found'));

            return redirect(route('socialMediaLinks.index'));
        }

        return view('socialMediaLinks.edit')->with('socialMediaLink', $socialMediaLink);
    }

    /**
     * Update the specified SocialMediaLink in storage.
     *
     * @param  int              $id
     * @param UpdateSocialMediaLinkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocialMediaLinkRequest $request)
    {
        $socialMediaLink = $this->socialMediaLinkRepository->find($id);

        if (empty($socialMediaLink)) {
            Flash::error(trans('socialMediaLink.messages.not_found'));

            return redirect(route('socialMediaLinks.index'));
        }

        $socialMediaLink = $this->socialMediaLinkRepository->update($request->all(), $id);

        Flash::success(trans('socialMediaLink.messages.updated'));

        return redirect(route('socialMediaLinks.index'));
    }

    /**
     * Remove the specified SocialMediaLink from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $socialMediaLink = $this->socialMediaLinkRepository->find($id);

        if (empty($socialMediaLink)) {
            Flash::error(trans('socialMediaLink.messages.not_found'));

            return redirect(route('socialMediaLinks.index'));
        }

        $this->socialMediaLinkRepository->delete($id);

        Flash::success(trans('socialMediaLink.messages.deleted'));

        return redirect(route('socialMediaLinks.index'));
    }
}
