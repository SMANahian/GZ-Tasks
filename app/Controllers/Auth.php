<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use \App\Entities\User;

class Auth extends BaseController
{

    public function auth($page = '')
    {
        if ((! is_file(APPPATH . 'Views/Auth/' . $page . '.php')) || $page == 'reset_password') {
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
            if(!password_verify($password, $user->password)) {
                return redirect()->back()->withInput()->with('error', 'Wrong password');
            }
            $session_data = [
                'id' => $user->id,
                'email' => $user->email,
                'isLoggedIn' => TRUE
            ];
            $session->set($session_data);
            return redirect()->to('/profile//'.$user->id.'/view');
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
            $user = new User();
            $user->name = $this->request->getVar('name');
            $user->email = $this->request->getVar('email');
            $user->password = $this->request->getVar('password');

            $model->save($user);
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
    public function reset() {
        $model = new UserModel();
        $email = $this->request->getVar('email');

        $user = $model->where('email', $email)->first();

        if($user) {
            $user->verify_key = md5(time().$user->email);
            $model->save($user);
            $url = base_url().'auth/reset/'.$user->id.'/'.$user->verify_key;

            $email = \Config\Services::email();

            $config = [
                'SMTPHost' => getenv('host'),
                'SMTPUser' => getenv('email'),
                'SMTPPass' => getenv('password'),
                'SMTPPort' => getenv('port'),
            ];

            $email->initialize($config);

            $email->setFrom('info@gz-task.com', 'GZ-Task');
            $email->setTo($user->email);
            $email->setSubject('Reset your password');
            $email->setMessage('Click this link to reset your password: '.$url);

            
            if (! $email->send() ) {
                return redirect()->back()->withInput()->with('error', 'Something went wrong');
            }
            
            return redirect()->to('/auth/login')->with('success', 'Check your email to reset your password');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid email address');
        }
    }
    public function resetPassword($id, $key) {
        $model = new UserModel();
        $user = $model->find($id);

        if($user) {
            if($user->verify_key == $key) {
                $data = [
                    'title' => 'Reset your password',
                    'id' => $user->id,
                    'verify_key' => $user->verify_key
                ];
                return view('Auth/reset_password', $data);
            } else {
                return redirect()->to('/auth/login')->with('error', 'Invalid key');
            }
        } else {
            return redirect()->to('/auth/login')->with('error', 'Invalid user');
        }
    }
    public function resetPass() {
        $rules = [
            'password' => ['rules' => 'required|min_length[8]|max_length[255]']
        ];
        if($this->validate($rules)) {
            $model = new UserModel();
            $id = $this->request->getVar('id');
            $key = $this->request->getVar('verify_key');
            $user = $model->find($id);

            if($user) {
                if($user->verify_key == $key) {
                    $user->password = $this->request->getVar('password');
                    $user->verify_key = '';
                    $model->save($user);
                    return redirect()->to('/auth/login')->with('success', 'Your password has been reset');
                } else {
                    return redirect()->to('/auth/login')->with('error', 'Invalid key');
                }
            } else {
                return redirect()->to('/auth/login')->with('error', 'Invalid user');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Password too short or too long');
        }
    }
}
