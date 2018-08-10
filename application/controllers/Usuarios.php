<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	/**
	 * Método principal do mini-crud
	 * @param nenhum
	 * @return view
	 */
	
	public function index()
	{
		$variaveis['result'] = $this->db->get('usuarios');
        $variaveis['titulo'] = 'Lista de Usuários';
		$this->load->view('usuarios', $variaveis);
    }
    
    public function create()
	{
		
		// // $variaveis['cadastros'] = $this->db->get('cadastros');
        // $this->load->view('index', $variaveis);
        
        $variaveis['titulo'] = 'Cadastro Usuários';
		$this->load->view('usuarios_cad', $variaveis);
	}

	public function store(){
		
		$this->load->library('form_validation');
		
		$regras = array(
		        array(
		                'field' => 'nome',
		                'label' => 'Nome',
		                'rules' => 'required'
		        ),
		        array(
		                'field' => 'email',
		                'label' => 'email',
		                'rules' => 'required|valid_email'		                
				),
				array(
					'field' => 'senha',
					'label' => 'senha',
					'rules' => 'required',
					'required' => 'Você deve preencher a %s.'		                
			)
		);
		
		
        
		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
            $variaveis['titulo'] = 'Novo Registro';
			
			$variaveis['mensagem'] = validation_errors();
			$this->load->view('usuarios', $variaveis);
		} else {
			
            $id = $this->input->post('id');
			
			$dados = array(
			
				"nome" => $this->input->post('nome'),
				"email" => $this->input->post('email'),
				"senha" => $this->input->post('senha')
			
			);
			
            if(empty($id)){
				$email = $this->input->post('email');
                $query = $this->db->query("SELECT * FROM usuarios where email = '$email'");
                $row = count($query->row());

                if($row >= 1){
                    $variaveis['alert'] = "Email já esta cadastrado.";
                    $variaveis['result'] = $this->db->get('usuarios');
                    $this->load->view('usuarios', $variaveis);
                    // redirect('/usuarios', 'location', 301);
                }
            }

			if ($this->m_usuarios->store($dados, $id)) {

                $variaveis['titulo'] = 'Lista de Usuários';
                $variaveis['mensagem'] = "Dados gravados com sucesso!";
                $variaveis['result'] = $this->db->get('usuarios');
                $this->load->view('usuarios', $variaveis);
                
			} else {
				$variaveis['mensagem'] = "Ocorreu um erro. Por favor, tente novamente.";
				$this->load->view('errors/html/v_erro', $variaveis);
            }
				
		}
	}


	/**
	 * Chama o formulário com os campos preenchidos pelo registro selecioando.
	 * @param $id do registro
	 * @return view
	 */
	public function edit($id = null){
		
		if ($id) {
			
			$cadastros = $this->m_usuarios->get($id);
			
			if ($cadastros->num_rows() > 0 ) {

				$variaveis['titulo'] = 'Edição de Registro';
				$variaveis['id'] = $cadastros->row()->id;
				$variaveis['nome'] = $cadastros->row()->nome;
                $variaveis['email'] = $cadastros->row()->email;
                
				$this->load->view('usuarios_cad', $variaveis);
			} else {
				$variaveis['mensagem'] = "Registro não encontrado." ;
				$this->load->view('errors/html/v_erro', $variaveis);
			}
			
		}
		
	}
	/**
	 * Função que exclui o registro através do id.
	 * @param $id do registro a ser excluído.
	 * @return boolean;
	 */
	public function delete($id = null) {
		if ($this->m_usuarios->delete($id)) {
			$variaveis['mensagem'] = "Registro excluído com sucesso!";
            $variaveis['result'] = $this->db->get('clientes');
			$this->load->view('usuarios', $variaveis);
		}
    }
}
