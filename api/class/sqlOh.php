<?php
class sqlOh
{
    private $host;
    private $login;
    private $password;
    private $name_bd;
    public function __construct(string $host, string $login, string $password, string $name_bd)
    {
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
        $this->name_bd = $name_bd;
    }

    public function getrooms($date)
    {
        $mysql = new mysqli($this->host, $this->login, $this->password, $this->name_bd);
        $orders_raw = $mysql->query("SELECT rooms.* FROM orders JOIN rooms ON room = id WHERE orders.date != {$date}");
        $roomsLoc = [];
        if ($orders_raw->num_rows > 0) {
            while ($row = $orders_raw->fetch_assoc()) {
                $roomsLoc[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'url_img' => $row['url_img'],
                    'description' => $row['description']    
                ];
            }
        }
    
        $mysql->close();
        return $roomsLoc;
    }


}

