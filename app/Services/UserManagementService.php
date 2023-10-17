<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserManagementService{
    public function updateOrInsertUsersData($request){
        $handeledUsers = json_decode($request->users, true);
        $currentCountOfUsers = User::count(); 

        $data = collect();

        foreach ($handeledUsers as $value) {
            $data->push([
                'first_name' => $value['name']['first'] ?? '',
                'last_name' => $value['name']['last'] ?? '',
                'age' => $value['dob']['age'] ?? '',
                'email' => $value['email'], 
                'password' => $value['login']['password']
            ]);
        }

        foreach ($data->chunk(500) as $chunk)
        {
            User::upsert($chunk->toArray(), ['first_name', 'last_name'] );
        }

        $total = User::count();
        $newAddedUsersCount = $total - $currentCountOfUsers;

        $result = [
            'total' => $total,
            'updated' => $total ?  count($handeledUsers) - $newAddedUsersCount : 0,
            'created' => $newAddedUsersCount ,
        ];

        return $result;
    }
}