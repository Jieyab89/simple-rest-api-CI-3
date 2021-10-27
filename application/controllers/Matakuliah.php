<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Matakuliah extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // MATAKULIAH
  function index_get()
  {
    $id = $this->get('kode_mk');

    if($id == '')
    {
      $matkul = $this->db->get('matakuliah')->result();
    }
    else
    {
      $this->db->where('kode_mk', $id);
      $matkul = $this->db->get('matakuliah')->result();
    }

    $this->response($matkul, REST_Controller::HTTP_OK);
  }

  function index_post()
  {
    $data = array
    (
      'kode_mk' => $this->post('kode_mk'),
      'nama' => $this->post('nama'),
      'semester' => $this->post('semester'),
      'sks' => $this->post('sks'),
      'sifat' => $this->post('sifat')
    );

    $insert = $this->db->insert('matakuliah', $data);

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
    $id = $this->get('kode_mk');
    $data = array
    (
      'kode_mk' => $this->put('kode_mk'),
      'nama' => $this->put('nama'),
      'semester' => $this->put('semester'),
      'sks' => $this->put('sks'),
      'sifat' => $this->put('sifat')
    );

    $this->db->where('kode_mk', $id);
    $update = $this->db->update('matakuliah', $data);

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
    $id = $this->get('kode_mk');
    $this->db->where('kode_mk', $id);
    $delete = $this->db->delete('matakuliah');

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
