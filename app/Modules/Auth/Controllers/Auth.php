<?php

namespace App\Modules\Auth\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Modules\Auth\Models\AuthModel;

class Auth extends BaseController
{
    public $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin');
        }
        return view('admin/auth/signin');
    }

    public function signin()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));

        $secret = '6LeO0E4jAAAAABEX4JoKJdAVuYlMdJFPi3GIkevy';

        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            $session->setFlashdata('msg', 'Check captcha first!');
            return redirect()->to('/login');
        }

        $data = $this->authModel->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                if ($data['status'] != 1) {
                    $session->setFlashdata('msg', 'Account status deactive!');
                    return redirect()->to('/login');
                }
                $update = [
                    'id' => $data['id'],
                    'last_login' => date("Y-m-d H:i:s"),
                    'last_login_ip' => $this->get_client_ip(),
                    'last_login_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'browser_name' => get_browser(null, true)['browser'],
                    'is_online' => 1
                ];
                $this->authModel->save($update);
                $ses_data = [
                    'id' => $data['id'],
                    'full_name' => $data['full_name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'role' => $data['rules'],
                    'isLoggedIn' => true
                ];
                $session->set($ses_data);
                return redirect()->to('/admin');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username does not exist.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // session()->remove($ses_data);
        $update = [
            'id' => session()->get('id'),
            'is_online' => 0
        ];
        $this->authModel->save($update);
        session()->destroy();
        return redirect()->to('/login');
    }

    public function activity()
    {
        $data = [
            'title' => 'Activity Log',
            'view' => 'admin/auth/activity',
            'data' => $this->authModel->find(session()->get('id'))
        ];

        return view('template/dashboard', $data);
    }

    private function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}