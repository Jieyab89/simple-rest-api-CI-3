<?php

class OtentikasiModel extends CI_Model
{
  function check_login($email, $password)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('email', $email);
    $this->db->or_where('password', $password);

    $query = $this->db->get();

    if($query->num_rows()>0)
    {
      return $query->result_array();
    }

    else
    {
      return "user not found";
    }
  }

  function insert_data($nama, $email, $password)
  {
    $this->nama = htmlspecialchars($_POST['nama']);
    //untuk memfildter karakter atau mencegah xss
    $this->email = $_POST['email'];
    $this->password = $_POST['password'];
    $this->db->insert('user', $this);
  }

}
