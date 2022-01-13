<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\BaseRepository;
use App\User;
use Laracasts\Flash\Flash;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version July 9, 2020, 4:03 pm UTC
*/

class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'address',
        'mobile',
        'address_id',
        'address_id',
        'main',
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
        return Address::class;
    }

    /**
     * List product ratings for selected product
     *
     * @param int $user_id
     *
     * @author Amk El-Kabbany at 18 June 2020
     * @contact alaa@upbeatdigital.team
     **/
    public function lists($user_id)
    {
        return User::where('deleted_at', null)->where('id', $user_id)
            ->first()->addresses;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Address
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $address = new Address();
        $address->fill($input)->save();

        if($address->main) {
            Address::where('id', '!=', $address->id)
                    ->where('user_id', $address->user->id)
                    ->where('main', true)->update(['main' => false]);
        }

        return $address;
    }


    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function update($input, $id)
    {
        $address = new Address();
        $address = $address->findOrFail($id);
        $address->fill($input)->save();

        if($address->main) {
            Address::where('id', '!=', $address->id)
                ->where('user_id', $address->user->id)
                ->where('main', true)->update(['main' => false]);
        }

        return $address;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @author Amk El-Kabbany at 9 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $address = $query->find($id);
        if($address->main) {
            Flash::error(trans('address.messages.errors.main'));
            return false;
        }

        $address->delete();

        return true;
    }
}
