<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\InputSurat;

class SuratMasuk extends ResourceController
{
   use ResponseTrait;
   // get all letters
   public function index()
  {
     $model = new InputSurat();
     $data = $model->findAll();
     return $this->respond($data, 200);
   }

   // get single product
   public function show($id = null)
   {
     $model = new InputSurat();
     $data = $model->getWhere(['id' => $id])->getResult();
     if($data){
        return $this->respond($data);
    }else{
       return $this->failNotFound('Tidak ada data dengan id '.$id);
    }
  }
  // create a new letter
  public function create()
  {
    $model = new ProductModel();
    $data = [
       'nomor_surat' => $this->request->getPost('nomor_surat'),
       'tanggal_surat' => $this->request>getPost('tanggal_surat'),
       'pengirim' => $this->request>getPost('pengirim'),
       'judul_surat' => $this->request>getPost('judul_surat')
   ];
   $data = json_decode(file_get_contents("php://input"));
   //$data = $this->request->getPost();
   $model->insert($data);
   $response = ['status'=> 201,
      'error' => null,
      'messages'=> ['success'=>'Data Saved']
   ];
   return $this->respondCreated($data,201);
}
 // update product
 public function update($id = null)
 {
   $model = new InputSurat();
   $json = $this->request->getJSON();
   if($json){
      $data = [
         'nomor_surat' => $json->nomor_surat,
         'tanggal_surat' => $json->tanggal_surat,
         'pengirim' => $json->pengirim,
         'judul_surat'=> $json->judul_surat
      ];
   }else{
      $input = $this->request->getRawInput();
      $data = [
         'nomor_surat' => $input['nomor_surat'],
         'tanggal_surat' => $input['tanggal_surat'],
         'pengirim' => $input['pengirim'],
         'judul_surat' => $input['judul_surat']
      ];
   }
   // Insert to Database
   $model->update($id, $data);
   $response = [
      'status'  => 200,
      'error'   => null,
      'messages' => [
         'success' => 'Data Updated'
         ]
        ];
        return $this->respond($response);
      }
   
      // delete letter
      public function delete($id = null)
      {
        $model = new InputSurat();
        $data = $model->find($id);
        if($data){
           $model->delete($id);
           $response = [
              'status'  => 200,
              'error'   => null,
              'messages' => [
                'success' => 'Berhasil menghapus'
              ]
           ];
           
           return $this->respondDeleted($response);
        }else{
           return $this->failNotFound('Data tidak ditemukan dengan id '.$id);
        }
        
      }
   
   }