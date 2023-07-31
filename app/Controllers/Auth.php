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

        return view('Auth/' . $page, $data);
    }

    public function login() {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if($user) {
            if(!password_verify($password, $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'Wrong password');
            }
            $session_data = [
                'id' => $user['id'],
                'email' => $user['email'],
                'isLoggedIn' => TRUE
            ];
            $session->set($session_data);
            return redirect()->to('/profile//'.$user['id'].'/view');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid username');
        }

    }

    public function signup() {
        $rules = [
            'name' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[user.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]']
        ];
        if($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/auth/login');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid inputs');
        }
    }
    public function logout() {
        $session = session();
        $session_data = [
            'id' => '',
            'email' => '',
            'isLoggedIn' => FALSE
        ];
        $session->set($session_data);
        return redirect()->to('/auth/login');
    }
}
