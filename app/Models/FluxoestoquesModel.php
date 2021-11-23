<?php

namespace App\Models;
use CodeIgniter\Model;

class FluxoestoquesModel extends Model{

    protected $table = 'fluxo_estoque';
    protected $primaryKey = 'id';

    protected $allowedFields = ['entrada_saida','quantidade','momento','produto_id',];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function getFluxoestoques($id = null){
        if($id === null){
            return $this->orderBy('momento','desc')->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

}