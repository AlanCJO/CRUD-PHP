<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga
{
    /**
     * Identificador único da vaga
     * @var integer
     */
    public $id;

    /**
     * Título da vaga
     * @var string
     */
    public $titulo;

    /**
     * Descrição da vaga (pode conter html)
     * @var string
     */
    public $descricao;


    /** Define se a vaga está ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Define a data
     * @var string
     */
    public $data;


    public function cadastrar():bool
    {
        // DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        // INSERIR A VAGA NO BANCO
        $obDatabase = new Database('vagas');

        // ATRIBUIR O ID DA VAGA NA INSTANCIA 
        $this->id = $obDatabase->insert([
                                        'titulo'    => $this->titulo,
                                        'descricao' => $this->descricao,
                                        'ativo'     => $this->ativo,
                                        'data'      => $this->data
                                        ]);

      
        // RETORNAR SUCESSO
        return true;
    }

    public function atualizar():bool
    {
        return (new Database('vagas'))->update('id = '.$this->id, [
                                                                    'titulo'    => $this->titulo,
                                                                    'descricao' => $this->descricao,
                                                                    'ativo'     => $this->ativo,
                                                                    'data'      => $this->data
                ]);
    }

    public function excluir():bool
    {
        return (new Database('vagas'))->delete('id = '.$this->id);
    }


    public static function getVagas($where = null, $order = null, $limit = null)
    {
        return (new Database('vagas'))->select($where, $order, $limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getVaga($id)
    {
        return (new Database('vagas'))->select('id = '.$id)
                                      ->fetchObject(self::class);
    }   
}
