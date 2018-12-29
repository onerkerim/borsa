<?php
class db {

  # @array,  The database settings
  private $settings;
  private $pdo;
  //veritabanına bağlantı
  public function __construct() {

    $this->Connect();

  }
  //veritabanı bağlantıyı kapat __destruct
  public function dbClose() {
      if($this->pdo) { $this->pdo = null; }
  }

   private function Connect()
    {
        $this->settings = parse_ini_file("settings.ini.php");
        $dsn            = 'mysql:dbname=' . $this->settings["dbname"] . ';host=' . $this->settings["host"] . '';
        try {
            # Read settings from INI file, set UTF8
            $this->pdo = new PDO($dsn, $this->settings["user"], $this->settings["password"], array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            
            # We can now log any exceptions on Fatal error. 
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            # Disable emulation of prepared statements, use REAL prepared statements instead.
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
        }
        catch (PDOException $e) {
            # Write into log
            echo "<b>HATA:Baglantı hatası</b> ". $e->getMessage();
            $this->dbClose();
            die();
        }
    }

    public function prepare($value) { 
        return $this->pdo->prepare($value); 
    }

    public function lastInsertId() { 
        return $this->pdo->lastInsertId(); 
    }
}

?>