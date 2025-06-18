<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel; 

class UserController extends BaseController
{
    protected $user; 

    function __construct()
    {
        $this->user = new UserModel();
    } 

    public function index()
    {
        $user = $this->user->findAll();
        $data['user'] = $user;

        return view('v_user', $data);
    }

		/*
    fungsi dibawah ini yang bertanggung jawab untuk
    menangani request dari http://localhost:8080/user/edit/23
    */
    public function edit($id)
    {
		    //pada fungsi harus diberi variable untuk menerima value dari parameter
		    //contohnya menggunakan variable $id
		    
		    $dataForm = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        
        $this->user->update($id, $dataForm);
        return redirect('user')->with('success', 'Data Berhasil Diubah');
    }
    
    public function create()
{
    $dataFoto = $this->request->getFile('foto');

    $dataForm = [
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'role' => $this->request->getPost('role'),
        'updated_at' => date("Y-m-d H:i:s")
    ];


    $this->user->insert($dataForm);

    return redirect('user')->with('success', 'Data Berhasil Ditambah');
} 

public function delete($id)
{
    $dataUser = $this->user->find($id);

    $this->user->delete($id);

    return redirect('user')->with('success', 'Data Berhasil Dihapus');
}

}