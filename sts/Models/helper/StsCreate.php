<?php
namespace App\sts\Models\helper;


if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

use PDO;
use Exception;

/**
 * helper StsCreate responsável pelo cadastro no banco de dados
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access private 
 *
*/
class StsCreate extends StsConn
{
    /** @var string $table Recebe o nome tabela onde salvará os dados */
    private string $table;

    /** @var array $data Recebe os dados para salvar na tabela */
    private array $data;

    /** @var string $result  Mostra o resultado se conseguiu cadastrar com sucesso ou não */
    private string $result;

    /** @var object $insert  Recebe a QUERY preparada para inserir no banco de dados*/
    private object $insert;

    /** @var string @query  Recebe a QUERY básica */
    private string $query;

    /** @var object $conn Recebe a conexão com o banco de dados*/
    private object $conn;

     /**
     * Retorna o status do cadastro, retorna o último id quando cadastrar com sucesso e null quando houver erro
     * @return string Retorna o último ID inserido
     */
    function getResult(): string {
        return $this->result;
    }

    /**
     * Cadastrar no banco de dados
     * 
     * @param string $table Recebe  nome da tabela
     * @param array $data Recebe os dados do formulário
     * @return void
     */
    public function exeCreate($table, array $data): void {
        $this->table = (string) $table;
        $this->data = $data;
        $this->exeReplaceValues();
        $this->exeInstruction();
    }
    
    /**
     * Cria a QUERY e os links da QUERY
     * 
     * @return void
     */
    private function exeReplaceValues(): void {
        $columns = implode(', ', array_keys($this->data));
        $values = ':' . implode(', :', array_keys($this->data));
        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
    }

     /**
     * Executa a QUERY. 
     * Quando executa a query com sucesso retorna o último id inserido, senão retorna null.
     * 
     * @return void
     */
    private function exeInstruction(): void {
        $this->connection();
        try {
            $this->insert->execute($this->data);
            $this->result = $this->conn->lastInsertId();
        } catch (Exception $ex) {
            $this->result = null;
        }
    }

    /**
     * Obtem a conexão com o banco de dados da classe pai "Conn".
     * Prepara uma instrução para execução e retorna um objeto de instrução.
     * 
     * @return void
     */
    private function connection(): void {
        $this->conn = $this->connect();
        $this->insert = $this->conn->prepare($this->query);
    }
 
}
 
?>