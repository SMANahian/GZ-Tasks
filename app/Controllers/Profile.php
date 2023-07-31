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
            $data = [
                'title' => 'Profile of'.$user['name'],
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            return view('Profile/view', $data);
        } else {
            throw new PageNotFoundException();
        }
    }

    public function edit($id)
    {
        $session = session();
        $model = new UserModel();
        $user = $model->find($id);

        if($user && $session->get('id') == $user['id']) {
            $data = [
                'title' => 'Profile of'.$user['name'],
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            return view('Profile/edit', $data);
        } else {
            throw new PageNotFoundException();
        }
    }

    public function update() {
        $session = session();
        $id = $session->get('id');
        $model = new UserModel();
        $user = $model->find($id);

        if($user) {
            $rules = [
                'name' => ['rules' => 'required|min_length[2]|max_length[255]'],
                'password' => ['rules' => 'required|min_length[8]|max_length[255]']
            ];
            if($this->validate($rules)) {
                $data = [
                    'id' => $id,
                    'name' => $this->request->getVar('name'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                ];
                $model->save($data);
                return redirect()->to('/profile//'.$id.'/view');
            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid inputs');
            }
        } else {
            throw new PageNotFoundException();
        }
    }
}
