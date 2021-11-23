<?php

namespace App\Controllers;
use CodeIgniter\Controller;

use App\Models\ProdutosModel;
use App\Models\FluxoestoquesModel;

class Produtos extends Controller{

    public function index(){
        $model = new ProdutosModel();
        $data = [
            'produtos' => $model->getProdutos()
        ];
        
        echo view('templates/header');
        echo view('produtos/overview', $data);
        echo view('templates/footer');
    }

    public function view($id = null){
        $model = new ProdutosModel();
        $data['produtos'] = $model->getProdutos($id);

        if(empty($data['produtos'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Não é possível encontrar o registro: ".$id);
        }

        $data['nome'] = $data['produtos']['nome'];

        echo view('templates/header');
        echo view('produtos/view', $data);
        echo view('templates/footer');
    }

    public function create(){
        helper('form');
        echo view('templates/header');
        echo view('produtos/form');
        echo view('templates/footer');
    }

    public function store(){
        helper('form');

        $model = new ProdutosModel();

        $rules = [
            'nome' => 'required|min_length[2]|max_length[100]',
            'valor_custo' => 'required',
            'valor_venda' => 'required'
        ];

        if($this->validate($rules)){
            $model->save([
                'id' => $this->request->getVar('id'),
                'nome' => $this->request->getVar('nome'),
                'descricao' => $this->request->getVar('descricao'),
                'valor_custo' => $this->request->getVar('valor_custo'),
                'valor_venda' => $this->request->getVar('valor_venda'),
                'quantidade' => $this->request->getVar('quantidade')
            ]);

            echo view('templates/header');
            echo view('produtos/success');
            echo view('templates/footer');
        }else{
            echo view('templates/header');
            echo view('produtos/form');
            echo view('templates/footer');
        }
    }

    public function edit($id = null){
        $model = new ProdutosModel();
        $data['produtos'] = $model->getProdutos($id);

        if(empty($data['produtos'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Registro não encontrado: '.$id);
        }

        $data = [
            'id' => $data['produtos']['id'],
            'nome' => $data['produtos']['nome'],
            'descricao' => $data['produtos']['descricao'],
            'valor_custo' => $data['produtos']['valor_custo'],
            'valor_venda' => $data['produtos']['valor_venda'],
            'quantidade' => $data['produtos']['quantidade']
        ];

        echo view('templates/header');
        echo view('produtos/form', $data);
        echo view('templates/footer');
    }

    public function delete($id = null){
        $model = new ProdutosModel();
        $model->delete($id);

        $model_fluxo = new FluxoestoquesModel();
        $model_fluxo->where('produto_id',$id);
        $model_fluxo->delete();

        echo view('templates/header');
        echo view('produtos/delete_success');
        echo view('templates/footer');
    }

    public function getAll(){
        $model = new ProdutosModel();
        $produtos = $model->getProdutos($id);
        return $produtos;
    }

}