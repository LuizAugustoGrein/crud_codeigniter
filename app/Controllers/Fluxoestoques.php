<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\FluxoestoquesModel;
use App\Models\ProdutosModel;

class Fluxoestoques extends Controller{

    public function index(){
        $model = new FluxoestoquesModel();
        $model_produtos = new ProdutosModel();
        $data = [
            'fluxoestoques' => $model->getFluxoestoques(),
            'produtos' => $model_produtos->getProdutos()
        ];
        
        echo view('templates/header');
        echo view('fluxoestoques/overview', $data);
        echo view('templates/footer');
    }

    public function view($id = null){
        $model = new FluxoestoquesModel();
        $model_produtos = new ProdutosModel();

        $data['fluxoestoques'] = $model->getFluxoestoques($id);

        if(empty($data['fluxoestoques'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Não é possível encontrar o registro: ".$id);
        }

        $data['produtos'] = $model_produtos->getProdutos();

        //$data['nome'] = $data['fluxoestoques']['nome'];

        echo view('templates/header');
        echo view('fluxoestoques/view', $data);
        echo view('templates/footer');
    }

    public function create(){
        $model_produtos = new ProdutosModel();
        $data_produtos = [
            'produtos' => $model_produtos->getProdutos()
        ];

        helper('form');
        echo view('templates/header');
        echo view('fluxoestoques/form', $data_produtos);
        echo view('templates/footer');
    }

    public function store(){
        helper('form');

        $model = new FluxoestoquesModel();
        $model_produtos = new ProdutosModel();
        $produto = $model_produtos->getProdutos($this->request->getVar('produto_id'));
        $fluxo = $model->getFluxoestoques($this->request->getVar('id'));

        $rules = [
            'entrada_saida' => 'required|min_length[1]|max_length[1]',
            'quantidade' => 'required',
            'momento' => 'required',
            'produto_id' => 'required',
        ];

        if($this->request->getVar('quantidade') > $produto['quantidade'] && $this->request->getVar('entrada_saida') == "s"){
            echo view('templates/header');
            echo view('fluxoestoques/error-qtd');
            echo view('templates/footer');
            return;
        }

        if($this->validate($rules)){
            /* VVV ATUALIZAR QUANTIDADE EM PRODUTOS VVV */
            if($this->request->getVar('id') == null){
                //ADICIONAR
                if($this->request->getVar('entrada_saida') == 'e')
                    $nova_qtd = $produto['quantidade'] + $this->request->getVar('quantidade');
                else
                    $nova_qtd = $produto['quantidade'] - $this->request->getVar('quantidade');
                $model_produtos->save([
                    'id' => $this->request->getVar('produto_id'),
                    'quantidade' => $nova_qtd
                ]);
            }else{
                //EDITAR
                if($fluxo['entrada_saida'] == $this->request->getVar('entrada_saida')){
                    $diferenca = $fluxo['quantidade'] - $this->request->getVar('quantidade');
                    if($this->request->getVar('entrada_saida') == 'e')
                        $nova_qtd = $produto['quantidade'] - $diferenca;
                    else
                        $nova_qtd = ($produto['quantidade'] + $diferenca);
                }else{
                    $diferenca = $this->request->getVar('quantidade');
                    if($this->request->getVar('entrada_saida') == 'e')
                        $nova_qtd = $produto['quantidade'] + ($diferenca * 2);
                    else
                        $nova_qtd = ($produto['quantidade'] - ($diferenca * 2));
                }
                $model_produtos->save([
                    'id' => $this->request->getVar('produto_id'),
                    'quantidade' => $nova_qtd
                ]);
            }
            /* ^^^ FIM DE ATUALIZAÇÃO DE QUANTIDADE EM PRODUTOS ^^^ */

            $model->save([
                'id' => $this->request->getVar('id'),
                'entrada_saida' => $this->request->getVar('entrada_saida'),
                'quantidade' => $this->request->getVar('quantidade'),
                'momento' => $this->request->getVar('momento'),
                'produto_id' => $this->request->getVar('produto_id')
            ]);


            echo view('templates/header');
            echo view('fluxoestoques/success');
            echo view('templates/footer');
        }else{
            $model_produtos = new ProdutosModel();
            $data_produtos = [
                'produtos' => $model_produtos->getProdutos()
            ];
            echo view('templates/header');
            echo view('fluxoestoques/form', $data_produtos);
            echo view('templates/footer');
        }
    }

    public function edit($id = null){
        helper('form');

        $model = new FluxoestoquesModel();
        $data['fluxoestoques'] = $model->getFluxoestoques($id);

        $model_produtos = new ProdutosModel();
        $data['produtos'] = $model_produtos->getProdutos();

        if(empty($data['fluxoestoques'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Registro não encontrado: '.$id);
        }

        $data = [
            'id' => $data['fluxoestoques']['id'],
            'entrada_saida' => $data['fluxoestoques']['entrada_saida'],
            'quantidade' => $data['fluxoestoques']['quantidade'],
            'momento' => $data['fluxoestoques']['momento'],
            'produto_id' => $data['fluxoestoques']['produto_id']
        ];

        $model_produtos = new ProdutosModel();
        $data['produtos'] = $model_produtos->getProdutos();

        echo view('templates/header');
        echo view('fluxoestoques/form', $data);
        echo view('templates/footer');
    }

    public function delete($id = null){
        $model = new FluxoestoquesModel();
        $fluxo = $model->getFluxoestoques($id);

        $model_produtos = new ProdutosModel();
        $produto = $model_produtos->getProdutos($fluxo['produto_id']);

        if($fluxo['entrada_saida'] == 'e')
            $nova_qtd = $produto['quantidade'] - $fluxo['quantidade'];
        else
            $nova_qtd = $produto['quantidade'] + $fluxo['quantidade'];
        $model_produtos->save([
            'id' => $fluxo['produto_id'],
            'quantidade' => $nova_qtd
        ]);

        $model = new FluxoestoquesModel();
        $model->delete($id);
        echo view('templates/header');
        echo view('fluxoestoques/delete_success');
        echo view('templates/footer');
    }

}