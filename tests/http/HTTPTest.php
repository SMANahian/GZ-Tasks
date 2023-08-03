<?php

namespace App;

use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\Fabricator;
use Tests\Support\Models\ExampleModel;

/**
 * @internal
 */

 class HTTPTest extends CIUnitTestCase {
    use DatabaseTestTrait;
    use FeatureTestTrait;

    public function testUserSignupAndLogin() {
        $fabricator = new Fabricator(UserModel::class);
        $users = $fabricator->make(5);

        // Sign up testing
        foreach ($users as $user) {
            $result = $this->post('/auth/signup', [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
            ]);
            $result->assertRedirectTo('/auth/login');
        }
        $model = new ExampleModel();
        $objects = $model->findAll();
        $this->assertCount(count($users), $objects);


        // Successfull Login testing
        foreach ($users as $user) {
            $result = $this->post('/auth/login', [
                'email' => $user->email,
                'password' => $user->password,
            ]);
            $result->assertSessionHas('isLoggedIn', TRUE);
        }


        // Unsuccessfull Login testing (wrong password)
        foreach ($users as $user) {
            $result = $this->post('/auth/login', [
                'email' => $user->email,
                'password' => 'wrongPass',
            ]);
            $result->assertSessionMissing('isLoggedIn');
        }


        // Unsuccessfull Login testing (wrong email)
        foreach ($users as $user) {
            $result = $this->post('/auth/login', [
                'email' => 'wrongEmail@gmail.com',
                'password' => $user->password,
            ]);
            $result->assertSessionMissing('isLoggedIn');
        }
    }



 }