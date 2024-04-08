<?php
namespace App\Controllers;
class Pages extends BaseController
{
    public function getIndex()
    {
        return view("welcome_message");
    }
    public function getView($page="home")
    {
        if (! is_file(APPPATH.'Views/pages/'.$page.'.php'))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $data['title'] = ucfirst($page);
        
        echo view("templates/header", $data);
        echo view("templates/navbar", $data);
        echo view("pages/".$page, $data);
        echo view("templates/footer", $data);
    }
}