<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Profile extends BaseController
{

    public function show($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if($user) {
            echo $user['name'];
        } 

    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if($user) {
            echo $user['name'];
        } 

    }
}
