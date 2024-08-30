<?php
//   Veilenler bazasini qeyd edirik burda bazanin adini, serverin adini
class Database
{
    private $host = 'localhost';  
    private $dbname = 'backendProject'; 
    private $username = 'root';
    private $password = '';
    private $conn;

    // burada isə method yaziriq ki əlaqə yaratsın
    public function conn()
    {
        $this->conn = null;
        try {
            // PDO (PHP Data Object) yardımıyla əlaqəni yaradiriq
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Əgər xəta olarsa onu idarə edirik 
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); // getMessage ile ise deyiremki eger elaqe yaranmasa xettani goster
        }
        return $this->conn; 
    }

    // Yeni məlumat elave etmək ucun metod yaziriq
    public function insert($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $this->conn->lastInsertId(); // lastInsertId sonuncu demekdi yeni ki sondaki Id-ni qaytarir.
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage(); // getMessage ile yeniden xetta olarsa goster deyirem
            return false;
        }
    }

    // Bütün məlumatları seçmək üçün metod
    public function selectAll($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query); // Sorgu hazirlayiriq
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll ile butun melumatlari return edirik
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage(); // getMessage ile yeniden xetta olarsa goster deyirem
            return false;
        }
    }

    // Bir məlumat üçün metod
    public function selectOne($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC); // fetch ile bir melumati return edirik
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage(); // getMessage ile yeniden xetta olarsa goster deyirem
            return false;
        }
    }

    // Məlumatı güncellemek ucun metod
    public function update($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount(); // rowCount ile  melumatlari sayir
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage(); // getMessage ile yeniden xetta olarsa goster deyirem
            return false;
        }
    }

    // Məlumatı silmek ucun metod
    public function delete($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount(); // rowCount ile  melumatlari sayir
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage(); // getMessage ile yeniden xetta olarsa goster deyirem
            return false;
        }
    }
}

// // Sinifdən istifadə
// $database = new Database();
// $connection = $database->conn();

?>


<!-- 
# $conn baza  ilə əlaqəni yaradırıq.
# insert ilə isə bazaya məlumat əlavə edirik.
# selectAll isə  tək-tək deyil hamsını seçirik , qaytarırıq.
# selectOne tek  seçirik.
# rowCount ile məlumatları sətirləri  sayırıq
# delete məlumatları və sətirləri silir.
 -->
