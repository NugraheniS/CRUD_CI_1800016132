<?php
namespace App\Controllers;
use App\Models\Mdl_user;

class User extends BaseController
{
   public function index()
   {
      if (session()->get('username') == '') {
         session()->setFlashdata('gagal', 'Please login to access this page');
         return redirect()->to(base_url('login'));
      }

      $model = new Mdl_user();
      $data['user'] = $model->get_user();

      return view('user_view', $data);
   }

   public function tambahdata()
   {
      echo view('tambah_data');
   }

   public function save()
   {
      $model = new Mdl_user();
      $data = [
         'id' => $this->request->getPost('id'),
         'username' => $this->request->getPost('username'),
         'email' => $this->request->getPost('email')
      ];
      $model->saveUser($data);
      return redirect()->to('/user');
   }

   public function delete($id)
   {
      $model = new Mdl_user();
      $model->deleteUser($id);
      return redirect()->to('/user');
   }

   public function edit($id)
   {
      $model = new Mdl_user();
      $data['user'] = $model->get_user($id)->getRow();
      return view('edit_data', $data);
   }

   public function updateData()
   {
      $model = new Mdl_user();
      $id = $this->request->getPost('id');
      $data = [
         'username' => $this->request->getPost('username'),
         'email' => $this->request->getPost('email')
      ];
      $model->updateUser($data, $id);
      return redirect()->to('/user');
   }
}