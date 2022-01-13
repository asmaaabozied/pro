<?php
/**
 * Voucher repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\Voucher;
use App\Repositories\BaseRepository;
use App\User;

/**
 * Class VoucherRepository
 * @package App\Repositories
 * @version May 31, 2020, 5:49 pm UTC
 *
 * @author Amk El-Kabbany at 31 May 2020
 * @contact alaa@upbeatdigital.team
*/

class VoucherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'title_en',
        'description_en',
        'code',
        'count',
        'usage',
        'rate',
        'start_date',
        'end_date'
    ];

    /**
     * Class constructor
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct()
    {
        parent::__construct(app());
        $this->fieldSearchable = array_keys(alterLangArrayElements('vouchers', ['fields' => array_combine($this->fieldSearchable,$this->fieldSearchable)], $key = 'fields')['fields']);
    }

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
        return Voucher::class;
    }

    /**
     * Validate given voucher code
     *
     * @param array $data
     * @return boolean
     *
     * @author Amk El-Kabbany at 8 July 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function validateVoucher($data)
    {
       
        $voucher = Voucher::where('deleted_at', null)->where('type', 'Orders')
                        ->whereDate('start_date', '<=', date('Y-m-d'))
                        ->whereDate('end_date', '>=', date('Y-m-d'))
                        ->where('code', $data['code'])
                        ->whereColumn('count', '>', 'usage');
        if($voucher->exists()){
            $status = User::find($data['user_id'])->validateVoucher($voucher->first()->id);
            return ($status == "false")? false : $voucher->first();
        }
        return false;
    }

    /**
     * Pluck model entries according to provided language
     *
     * @param string $language
     * @param  boolean $activated
     * @return array
     *
     * @author Amk El-Kabbany at 31 May 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function pluck($language, $activated = null)
    {
        $title = 'title_'.$language;
        return Voucher::where('deleted_at', null)->when($activated != null, function ($query){
            return $query->whereDate('end_date', '>=', date('Y-m-d'));
        })->orderBy('end_date')->pluck($title, 'id');
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Voucher
     *
     * @author Amk El-Kabbany at 31 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $voucher = new Voucher();
        $voucher->fill($input)->save();

        return $voucher;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 31 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $voucher = new Voucher();
        $voucher = $voucher->findOrFail($id);
        $voucher->fill($input)->save();
        return $voucher;
    }
}
