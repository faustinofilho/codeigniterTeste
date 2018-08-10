<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	/**
	 * Método principal do mini-crud
	 * @param nenhum
	 * @return view
	 */
	
	public function index()
	{
		
		$variaveis['result'] = $this->db->get('clientes');
        
        $variaveis['titulo'] = 'Lista de Clientes';
		$this->load->view('clientes', $variaveis);
    }
    
    public function create()
	{
        $variaveis['titulo'] = 'Cadastro Clientes';
		$this->load->view('clientes_cad', $variaveis);
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
		                'field' => 'cnpj',
		                'label' => 'cnpj',
		                'rules' => 'required'		                
		        )
		);
        
        
		$this->form_validation->set_rules($regras);

		if ($this->form_validation->run() == FALSE) {
            $variaveis['titulo'] = 'Novo Registro';
            
			$this->load->view('clientes_cad', $variaveis);
		} else {
			
            $config = array(
                'upload_path' => "./arquivos/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => TRUE,
                'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "768",
                'max_width' => "1024"
            );
            $this->load->library('upload', $config);

            
            if($this->upload->do_upload('logo'))
            {

                $data = array('upload_data' => $this->upload->data());
                // $this->load->view('clientes',$data);
            }
            else
            {
                $error = array('mensagem' => $this->upload->display_errors());
                $error['result'] = $this->db->get('clientes');
                $this->load->view('clientes', $error);
            }
            


            $id = $this->input->post('id');
			
			$dados = array(
			
				"nome" => $this->input->post('nome'),
				"cnpj" => $this->input->post('cnpj')
			
            );
            
            $dados['logo'] = $_FILES['logo']["name"];

            if(empty($id)){

                $cnpj = $this->input->post('cnpj');
                $query = $this->db->query("SELECT * FROM clientes where cnpj= '$cnpj'");
                $row = count($query->row());

                if($row >= 1){
                    $variaveis['alert'] = "CNPJ já esta cadastrado.";
                    $variaveis['result'] = $this->db->get('clientes');
                    $this->load->view('clientes', $variaveis);
                    redirect('/clientes', 'location', 301);
                }
            }

			if ($this->m_clientes->store($dados, $id)) {

                $variaveis['titulo'] = 'Lista de Clientes';
                $variaveis['mensagem'] = "Dados gravados com sucesso!";
                $variaveis['result'] = $this->db->get('clientes');
                $this->load->view('clientes', $variaveis);
                
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
			
			$cadastros = $this->m_clientes->get($id);
			
			if ($cadastros->num_rows() > 0 ) {

				$variaveis['titulo'] = 'Edição de Registro';
				$variaveis['id'] = $cadastros->row()->id;
				$variaveis['nome'] = $cadastros->row()->nome;
                $variaveis['cnpj'] = $cadastros->row()->cnpj;
                
				$this->load->view('clientes_cad', $variaveis);
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
		if ($this->m_clientes->delete($id)) {
            $variaveis['mensagem'] = "Registro excluído com sucesso!";
            $variaveis['result'] = $this->db->get('clientes');
			$this->load->view('clientes', $variaveis);
		}
    }
    
    function validar_cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
}
