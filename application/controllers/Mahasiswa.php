<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Mahasiswa extends REST_Controller
{

  //function yang akan mengeksuki sebelum function berikutnya

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function index_get()
  {
    $id = $this->get('npm');

    if($id == '')
    {
      $mahasiswa = $this->db->get('mahasiswa')->result();
    }
    else
    {
      $this->db->where('npm', $id);
      $mahasiswa = $this->db->get('mahasiswa')->result();
    }

    $this->response($mahasiswa, REST_Controller::HTTP_OK);
  }

  function index_post()
  {
    $data = array
    (
      'npm' => $this->post('npm'),
      'nama' => $this->post('nama'),
      'gender' => $this->post('gender'),
      'fakultas' => $this->post('fakultas'),
      'prodi' => $this->post('prodi')
    );

    $insert = $this->db->insert('mahasiswa', $data);

    if($insert)
    {
      $this->response($data, REST_Controller::HTTP_OK);
    }
    else
    {
      $this->response(array('status' => 'fail', 502));
    }
  }

  function index_put()
  {
    $id = $this->get('npm');
    $data = array
    (
      'npm' => $this->put('npm'),
      'nama' => $this->put('nama'),
      'gender' => $this->put('gender'),
      'fakultas' => $this->put('fakultas'),
      'prodi' => $this->put('prodi')
    );

    $this->db->where('npm', $id);
    $update = $this->db->update('mahasiswa', $data);

    if($update)
    {
      $this->response($data, REST_Controller::HTTP_OK);
    }
    else
    {
      $this->response(array('status' => 'fail', 502));
    }

  }

  function index_delete()
  {
    $id = $this->delete('npm');
    $this->db->where('npm', $id);
    $delete = $this->db->delete('mahasiswa');

    if($delete)
    {
      $this->response(array('status' => 'OK', 200));
    }
    else
    {
      $this->response(array('status' => 'fail', 502));
    }
  }

}

 ?>
