<?php

use Illuminate\Database\Seeder;
use App\Models\AccountsType;

class DefaultAccountTypesSeeder extends Seeder
{
    /**
     * Seed default applications account types in account_types table
     * @return void
     *
     * @author Amk El-Kabbany at 5 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function run()
    {
        $types = [];
        foreach (trans('account_type.account_types') as $key => $type){
            $types[] = [
              'id'   => $key,
              'type' => $type,
            ];
        }
        AccountsType::insert($types);
    }
}
