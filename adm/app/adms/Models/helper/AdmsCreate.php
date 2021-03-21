<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

use Exception;

/**
 * AdmsCreate Helper. Responsible for registering records in the database.
 *
 * @author ACD
 */

class AdmsCreate extends AdmsConn
{

    /** @var string $table Receives the table name */
    private string $table;
    /** @var array $data Receives the data that must be inserted in the database. */
    private array $data;
    /** @var string $result Return registration status. */
    private string $result;
    /** @var object $insert Receives the QUERY ready. */
    private object $insert;
    /** @var string $query Receives the QUERY */
    private string $query;
    /** @var object $conn Receives the database connection. */
    private object $conn;

    /**
     * Return the status of the record, returns the last id when successfully registered and null when an error occurs.
     * 
     * @return string Return the last registered id.
     */
    function getCreateResult(): string {
        return $this->result;
    }

    /**
     * Register in the database.
     * 
     * @param string $table Receives the table name
     * @param array $data Receives form data.
     * @return void
     */
    public function exeCreate($table, array $data): void {
        $this->table = (string) $table;
        $this->data = $data;
        $this->exeReplaceValues();
        $this->exeIntruction();
    }

    /**
     * Create QUERY and QUERY links
     * 
     * @return void
     */
    private function exeReplaceValues(): void {
        $coluns = implode(', ', array_keys($this->data));
        $values = ':' . implode(', :', array_keys($this->data));
        $this->query = "INSERT INTO {$this->table} ({$coluns}) VALUES ({$values})";
    }

    /**
     * Run the QUERY. 
     * When you run the query successfully, it returns the last id entered, otherwise it returns null.
     * 
     * @return void
     */
    private function exeIntruction(): void {
        $this->connection();
        try {
            $this->insert->execute($this->data);
            $this->result = $this->conn->lastInsertId();
        } catch (Exception $ex) {
            $this->result = null;
        }
    }

    /**
     * Gets the connection to the parent class database "Conn".
     * Prepares an instruction for execution and returns an instruction object.
     * 
     * @return void
     */
    private function connection(): void {
        $this->conn = $this->connect();
        $this->insert = $this->conn->prepare($this->query);
    }

}
