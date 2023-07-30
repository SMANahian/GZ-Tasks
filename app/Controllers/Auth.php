<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Auth extends BaseController
{

    public function auth($page = 'login')
    {
        if (! is_file(APPPATH . 'Views/Auth/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('Auth/' . $page)
            . view('templates/footer');
    }

    public function login() {

    }
    public function signup() {
        $model = new UserModel();

        $model->save($_POST);
    }
}
