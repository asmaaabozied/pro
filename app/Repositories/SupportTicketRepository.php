<?php
/**
 * Support Ticket repository class which handel more of logic actions
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Repositories;

use App\Models\SupportTicket;
use App\Repositories\BaseRepository;

/**
 * Class SupportTicketRepository
 * @package App\Repositories
 * @version June 9, 2020, 12:18 am UTC
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
*/

class SupportTicketRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'type',
        'message',
        'responded'
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
        return SupportTicket::class;
    }


    /**
     * Create model record
     *
     * @param array $input
     *
     * @return SupportTicket
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function create($input)
    {
        $supportTicket = new SupportTicket();
        $supportTicket->fill($input)->save();

        return $supportTicket;
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
        $supportTicket = new SupportTicket();
        $supportTicket = $supportTicket->findOrFail($id);
        $supportTicket->fill($input)->save();
        return $supportTicket;
    }
}
