<?php
/**
 * About us controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 3 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers;

use App\Core\Controllers\CustomizedAppBaseController;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash\Flash;

class AboutUsController extends CustomizedAppBaseController
{

    public function update(){

        dd('yes');

    }
    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 3 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct()
    {
        parent::__construct();
        $this->language = Config::get('languages')[Request::ip()]['admin'];
    }

    /**
     * Display the specified AboutUs.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $slug = ($id == 1)? 'about-us' : (($id == 2)? 'terms-and-conditions' : 'privacy-and-policy');
        $aboutUs = AboutUs::where('deleted_at', null)->where('slug', $slug)->get();


        return view('aboutuses.show', compact('id', 'aboutUs', 'slug'));
    }

    /**
     * Show the form for editing the specified AboutUs.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $slug = ($id == 1)? 'about-us' : 'terms-and-conditions';
        $aboutUs = AboutUs::where('deleted_at', null)->where('slug', $slug)->get();
        return view('aboutuses.edit', compact('id', 'aboutUs', 'slug'));
    }

    /**
     * <Ajax POST Action -.addParagraph js/script.blade.php->
     * Route action add new record to selected object
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function addParagraph() {
        $slug = $_POST['slug'];


        $paragraph = [
            'slug' => strval($slug),
        ];
        $object = new AboutUs();
        $object->fill($paragraph)->save();
        return $object->id;
    }

    /**
     * <Ajax POST Action -.deleteParagraph js/script.blade.php->
     * Route action delete selected record
     *
     * @return boolean
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function deleteParagraph() {
        $id = $_POST['id'];
        if (in_array($id, [1,2])) {
            $paragraph = AboutUs::find($id);
            $paragraph->delete();
            exit(json_encode(true));
        } else {
            exit(json_encode(false));
        }
    }

    /**
     * <Ajax POST Action -.title js/script.blade.php->
     * Route action edit selected record paragraph title
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphTitle() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $object = AboutUs::find($id);
        $object->$name = $_POST['value'];
        $object->save();

        exit(json_encode([$name . $id]));
    }

    /**
     * <Ajax POST Action -.description js/script.blade.php->
     * Route action edit selected record paragraph description
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphDescription() {


        $id = $_POST['id'];
//dd($id);
        $name = $_POST['name'];
        $object = AboutUs::find($id);
        $object->$name = $_POST['value'];
        $object->save();

        exit(json_encode([$name . $id]));
    }

    /**
     * <Ajax POST Action -.active js/script.blade.php->
     * Route action edit selected record paragraph active attribute
     *
     * @return array
     *
     * @author Amk El-Kabbany at 10 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphActive() {
        $id = $_POST['id'];
        $object = AboutUs::find($id);
        $object->active = ($_POST['value'] == 'true') ? true : false;
        $object->save();

        exit(json_encode(['active' . $id]));
    }

    /**
     * <Ajax POST Action -.image js/script.blade.php->
     * Route action edit selected record paragraph image
     *
     * @return array
     *
     * @author Amk El-Kabbany at 22 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public function editParagraphImage() {
        dd($_POST);
        $id = $_POST['id'];
        $object = AboutUs::find($id);
        $object->active = ($_POST['value'] == 'true') ? true : false;
        $object->save();

        exit(json_encode(['active' . $id]));
    }
}
