<?php
class shop
{
    public $id;
    public $nama;
    public $ukuran;
    public $harga;

    private $conn;
    private $table = "tbl_barang";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function add()
    {
        $query = "INSERT INTO
                " . $this->table . "
            SET
               id=:id, nama=:nama, ukuran=:ukuran, harga=:harga";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('nama', $this->nama);
        $stmt->bindParam('ukuran', $this->ukuran);
        $stmt->bindParam('harga', $this->harga);

        //if ($stmt->execute()) {
            return true;
        //}
        return false;

        
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($ $query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function fetch()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function get()
    {
        $query = "SELECT * FROM " . $this->table . " p          
                WHERE
                    p.id = ?
                LIMIT
                0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $shop = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $shop['id'];
        $this->nama = $shop['nama'];
        $this->ukuran = $shop['ukuran'];
        $this->harga = $shop['harga'];
    }

    function update()
    {
     $query = "UPDATE
                " . $this->table . "
            SET
                nama= :nama,
                ukuran= :ukuran,
                harga = :harga
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('nama', $this->nama);
        $stmt->bindParam('ukuran', $this->ukuran);
        $stmt->bindParam('harga', $this->harga);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}