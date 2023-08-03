<?php

use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

/**
 * @internal
 */
final class ExampleSessionTest extends CIUnitTestCase
{
    public function testSessionSimple()
    {
        // $session = Services::session();

        // $session->set('logged_in', 123);
        // $this->assertSame(123, $session->get('logged_in'));

        $session = Services::session();

        $session_data = [
            'id' => 2,
            'email' => 'rakib@codeigniter4.com',
            'isLoggedIn' => TRUE
        ];
        $session->set($session_data);

        $this->assertSame(TRUE, $session->get('isLoggedIn'));
    }
}
