<?php

/**
 * Abstract model base event class. TODO: change the documentation
 *
@author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

namespace App\Events;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Abstract model base event class. TODO: change the documentation
 * @package App\Events
 *
@author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

abstract class ModelBasedEvent extends BaseEvent
{
    use Queueable;

    /**
     * The module object.
     *
     * @var EloquentModel
     *
    @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public $model;

    /**
     * ModelBased Event Constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
    @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct(EloquentModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * Get current event request model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     *

     */
    public function getModel(): EloquentModel
    {
        return $this->model;
    }

}