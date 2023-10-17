<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserManagementService{
    public function updateOrInsertUsersData($request){
        $handeledUsers = json_decode($request->users, true);

        $data = collect();
        $currentCountOfUsers = User::count(); 

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
            'updated' => count($handeledUsers) - $newAddedUsersCount ,
            'created' => $newAddedUsersCount ,
            'total' => $total,
        ];

        return $result;
    }
}