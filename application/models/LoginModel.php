<?php
	
	class LoginModel extends CI_Model{

		function getUser($email, $password){
			$this->db->where('email', $email);
			$this->db->where('password', $password);
            $this->db->limit(1);
        	$query = $this->db->get('usuarios');
			
			if($query->num_rows() == 1)
		    {
			    return $query->row();
		    }else{
			     return false;
		    }
		}

		function insertUsuarioAdmin($nombre, $apellido, $email, $password, $rol){
	        $data = array(
	            'nombre' => $nombre,
	            'apellido' => $apellido,
	            'email' => $email,
	            'password' => $password,
	            'rol' => $rol
	        );

	        return $this->db->insert('usuarios', $data);
	    }
	}

?>
