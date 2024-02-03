<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->get('id')>0) {

            $data['title']='Dashboard';
            $data['desc']='Selamat datang di Website GT Kasir. Selamat Membaca!';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu', $data); 
            echo view('hopeui/dashboard/view', $data);
            echo view('hopeui/partial/footer');

        }else{
            return redirect()->to('/');
        }
    }
}
