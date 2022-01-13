<?php
/**
 * Common API controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 16 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class CommonController
 * @package App\Http\Controllers\API
 *
 * @author Amk El-Kabbany at 16 June 2020
 * @contact alaa@upbeatdigital.team
 */

class CommonAPIController extends AppBaseController
{
    /**
     * Current Logged User Selected Language Prefix
     *
     * @var string
     *
     * @author Amk El-Kabbany at 16 June 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $language;

    public function __construct()
    {
        $this->language = request()->header('Accept-Language');
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $categories = (new CategoryRepository())->search($request->input('term'));
        $categories = CategoryResource::toArray($categories, $this->language);

        $products = (new ProductRepository())->search($request->input('term'));
        $products = ProductResource::toArray($products, $this->language);

        return $this->sendResponse(['categories' => $categories, 'products' => $products], trans('common.messages.retrieved'));
    }

    public function shippingAPI(Request $request){
        $in['AwbNumber'] = $request->parameters;
        // dd($in);
        $post_data = json_encode($in);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://portal.teamex.ae/webservice/GetTracking",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post_data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "API-KEY:a3835f1e9cc9d83a3e074f045586ec6f",
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return $response;
    }
}
