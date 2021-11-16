<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Otentikasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('OtentikasiModel');
  }

  public function index()
  {
    $jwt = new JWT();

    $jwtSecretkey = 'Secretkeycontohrest';
    $token = $jwt->encode($jwtSecretkey, 'HS256');

    echo $token;
  }

  /*
  public function token()
  {
    $jwt = new JWT();

    $jwtSecretkey = 'Secretkeycontohrest';
    $data = array(
      'userId' => 1,
      'email' => 'bayutest@mail.com',
      'userType' => 'admin',
    );

    $token = $jwt->encode($data, $jwtSecretkey, 'HS256');
    echo $token;
  }

  public function decode_token()
  {
    $token = $this->uri->segment(3);
    $jwt = new JWT();
    $jwtSecretkey = 'Secretkeycontohrest';
    $decode_token = $jwt->decode($token, $jwtSecretkey, 'hs256');
    $tokendecode = $jwt->jsonEncode($decode_token);

    echo $tokendecode;
  }
  */

  public function login()
  {
    $jwt = new JWT();

    $jwtSecretkey = 'Secretkeycontohrest';
    $token = $jwt->encode($jwtSecretkey, 'HS256');

    $cek_it = $token = $this->input->post('token');

    if($cek_it)
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $result = $this->OtentikasiModel->check_login($email, $password);

      echo json_encode($result);
    }

    else
    {
      echo "Not found";
      //echo json_encode($token);
    }

  }

  public function insert()
  {
    $jwt = new JWT();

    $jwtSecretkey = 'Secretkeycontohrest';
    $token = $jwt->encode($jwtSecretkey, 'HS256');

    $cek_it = $token = $this->input->post('token');

    if($cek_it)
    {
      $nama = $this->input->post('nama');
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $insert = $this->OtentikasiModel->insert_data('user', $nama, $email, $password);

      echo json_encode($insert . " " . $token);
      echo "Succses";
    }

    else
    {
      echo "Please insert your token :D";
      //echo json_encode($token);
    }

  }

}
