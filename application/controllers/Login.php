<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$this->load->view('panel/header-login');
		$this->load->view('panel/form-login');
		$this->load->view('panel/footer');
	}

	public function admin(){
		$this->load->view('panel/header');
		$this->load->view('panel/form-login');
		$this->load->view('panel/footer');
	}

	public function nuevoRegistroAdmin(){
		$this->load->view('panel/header');
		$this->load->view('panel/form-registro-admin');
		$this->load->view('panel/footer');
	}

	public function ingresar(){

		if(isset($_POST['email'])){
			$email = $this->input->post('email');
		}else{
			$this->session->set_flashdata('email', 'Correo Electrónico incorrecto');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}
		
		if(isset($_POST['password'])){
			$password = $this->input->post('password');
		}else{
			$this->session->set_flashdata('password', 'Contraseña incorrecta');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}
		
		$check_user = $this->LoginModel->getUser($email, $password);
		
		if($check_user == TRUE)
		{
			$data = array(
	                'is_logued_in' 	=> 	TRUE,
	                'id' 	        => 	$check_user->id,
	                'email' 		=> 	$check_user->email,
                    'password' 	=> 	$check_user->password
            	);

			$this->session->set_userdata($data);
			header("location:" . base_url().'Panel');
		}
		else{
			$this->session->set_flashdata('login_incorrecto', 'Usuario y/o Contraseña incorrecta');
			header("location:" . base_url().'Login');
			exit();
		}
               
	}

	public function registrarAdmin(){

		if(isset($_POST['nombre'])){
			$nombre = $this->input->post('nombre');
		}else{
			$this->session->set_flashdata('nombre', 'Debe ingresar su nombre');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}

		if(isset($_POST['apellido'])){
			$apellido = $this->input->post('apellido');
		}else{
			$this->session->set_flashdata('apellido', 'Debe ingresar su apellido');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}

		if(isset($_POST['email'])){
			$email = $this->input->post('email');
		}else{
			$this->session->set_flashdata('email', 'Debe ingresar su correo electrónico');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}
		
		if(isset($_POST['password'])){
			$password = $this->input->post('password');
		}else{
			$this->session->set_flashdata('password', 'Contraseña incorrecta');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}

		if(isset($_POST['confirmarPassword'])){
			$confirmarPassword = $this->input->post('confirmarPassword');
		}else{
			$this->session->set_flashdata('confirmarPassword', 'Debe confirmar su Contraseña');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}

		if(isset($_POST['rol'])){
			$rol = $this->input->post('rol');
		}else{
			$rol = '';
		}

		if($password != $confirmarPassword){
			$this->session->set_flashdata('noCoincidenPassword', 'Su Contraseña no coincide con la confirmación');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}
		
		$check_user = $this->LoginModel->insertUsuarioAdmin($nombre, $apellido, $email, $password, $rol);
		
		if($check_user == TRUE)
		{
			$data = array(
	                'is_logued_in' 	=> 	TRUE,
	                'id' 	        => 	$check_user->id,
	                'email' 		=> 	$check_user->email,
                    'password' 		=> 	$check_user->password
            	);

			$this->session->set_userdata($data);
			header("location:" . base_url().'Panel');
		}
		else{
			$this->session->set_flashdata('login_incorrecto', 'Hubo un error en el registro');
			header("location:" . base_url().'Login');
			exit();
		}
               
	}

	public function registrarUsuario(){

		if(isset($_POST['user'])){
			$user = $this->input->post('user');
		}else{
			$this->session->set_flashdata('user', 'Usuario incorrecto');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}
		
		if(isset($_POST['password'])){
			$password = $this->input->post('password');
		}else{
			$this->session->set_flashdata('password', 'Contraseña incorrecta');
 			header("location:" . base_url().'Login/admin');
 			exit();
		}
		
		$check_user = $this->LoginModel->getUser($user, $password);
		
		if($check_user == TRUE)
		{
			$data = array(
	                'is_logued_in' 	=> 	TRUE,
	                'id' 	        => 	$check_user->id,
	                'user' 		=> 	$check_user->user,
                    'password' 	=> 	$check_user->password
            	);

			$this->session->set_userdata($data);
			header("location:" . base_url().'Panel');
		}
		else{
			$this->session->set_flashdata('login_incorrecto', 'Usuario y/o Contraseña incorrecta');
			header("location:" . base_url().'Login');
			exit();
		}
               
}

	function logout(){

		$this->session->sess_destroy();
		header("location:" . base_url() . "Login/");
	}
}

?>
