<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class User extends Controller
{
    protected $helpers = ['url', 'form'];
    public function getAdmin_list()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['content'] = view('user/list', $data);
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("user/list", $data);
        echo view("templates/footer", $data);
    }
    public function getLogin()
    {
        $data['content'] = view('pages/login');
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/login", $data);
        echo view("templates/footer", $data);
    }
    public function getUser_ok()
    {
        $data['content'] = view('user/user_ok', ['name'=> session()->user->name]);
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("user/user_ok", $data);
        echo view("templates/footer", $data);
    }

    public function postLogin()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $rules = [
            "email" => [
                "label" => "email",
                "rules" => "required"
            ],
            "password" => [
                "label" => "password",
                "rules" => "required"
            ]
        ];
        $data = [];
        $session = session();
        if ($this->validate($rules)) {
            $email = $request->getVar('email');
            $password = $request->getVar('password');
            $user = model('UserModel')->authenticate($email, $password);
            if ($user) {
                $session->set('logged_in', TRUE);
                $session->set('user', $user);
                return redirect()->to(base_url('user/user_ok'));
            } else {
                $session->setFlashdata('msg', 'Wrong credentials');
            }
        } else {
            $data["errors"] = $validation->getErrors();
        }
        $data['content'] = view('pages/login', $data);
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/login", $data);
        echo view("templates/footer", $data);
    }

    public function getLogout()
    {
        session()->destroy();
        return redirect()->to(base_url('pages/login'));
    }

}