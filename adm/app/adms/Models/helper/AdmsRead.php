<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

use PDO;
use Exception;

/**
 * AdmsRead Generic helper to search the record in the database.
 *
 * @author acd
 */
class AdmsRead extends AdmsConn
{

    /** @var string $select Receive QUERY */
    private string $select;

    /** @var array $values Receive the values that must be assigned on the QUERY links with bindValue*/
    private array $values = [];

    /** @var array $result Receives records from the database and returns to Models */
    private array $result = [];

    /** @var object $query Receive the prepared QUERY */
    private object $query;

    /** @var object $conn Receive the connection */
    private object $conn;

    /**
     * 
     * @return array Returns the data array.
     */
    function getReadingResult(): array {
        return $this->result;
    }

    /**  
     * Receive the values to set up the QUERY.
     * Convert the parseString from string to array.
     * @param string $table Receive the name of the database table.
     * @param string $terms Receive QUERY terms, ex: adms_situation_id =:adms_situation_id
     * @param string $parseString Receives the values that must be replaced on the link, ex: adms_situation_id=1
     * 
     * @return void
     */
    public function exeRead($table, $terms = null, $parseString = null): void {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms}";
        $this->exeIntruction();
    }

    /**
     * Receive the values to set up the QUERY.
     * Convert the parseString from string to array.
     * @param string $query Receive model QUERY.
     * @param string $parseString Receive the valus that must be replaced on the link, ex: adms_situation_id=1
     * 
     * @return void
     */
    public function fullRead($query, $parseString = null): void {
        $this->select = $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->exeIntruction(); 
    }

    /**
     * Run the QUERY. 
     * When you run the query successfully, it returns the data array, otherswise it returns null.
     * 
     * @return void
     */
    private function exeIntruction(): void {
        $this->connection();
        try {
            $this->exeParameter();
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (Exception $ex) {
            $this->result = null;
        }
    }

    /**
     * Obtains the connection to the parent class database "Conn".
     * Prepares an instruction for execution and returns an instruction object.
     * 
     * @return void
     */
    private function connection(): void {
        $this->conn = $this->connect();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * Replaces QUERY links with values using bindValue.
     * 
     * @return void
     */
    private function exeParameter(): void {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                if ($link == 'limit' || $link == 'offset') {
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
                
            }
        }
    }

}
