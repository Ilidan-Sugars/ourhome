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
        mysqli_set_charset($mysql, "utf8mb4");
        $orders_raw = $mysql->query("SELECT * FROM rooms WHERE id NOT IN (SELECT room FROM orders WHERE date = '$date');");
        $roomsLoc = [];
        if ($orders_raw->num_rows > 0) {
            while ($row = $orders_raw->fetch_assoc()) {
                $roomsLoc[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'url_img' => $row['url_img'],
                    'description' => $row['description'],
                    'price' => $row['price']
                ];
            }
        }

        $mysql->close();
        return $roomsLoc;
    }
    public function getroom($room_id)
    {
        $mysql = new mysqli($this->host, $this->login, $this->password, $this->name_bd);
        mysqli_set_charset($mysql, "utf8mb4");
        $orders_raw = $mysql->query("SELECT * FROM `rooms` WHERE id='$room_id';");
        $roomsLoc = [];
        if ($orders_raw->num_rows > 0) {
            while ($row = $orders_raw->fetch_assoc()) {
                $roomsLoc[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'url_img' => $row['url_img'],
                    'description' => $row['description'],
                    'price' => $row['price']
                ];
            }
        }

        $mysql->close();
        return $roomsLoc;
    }

    public function placeOrder($id_room, $date, $name, $number, $email, $tel, $coment)
    {
        $mysql = new mysqli($this->host, $this->login, $this->password, $this->name_bd);
        mysqli_set_charset($mysql, "utf8mb4");
        $Examination = $mysql->query("SELECT * FROM `orders` WHERE date = '" . $date . "' AND room = '" . $id_room . "'");
        

        if ($Examination->{'num_rows'} == '0') {
            $test = $mysql->query("INSERT INTO `orders` (`id`, `room`, `date`, `num_people`, `tel`, `name`, `comment`, `email`) VALUES (NULL, '" . $id_room . "', '" . $date . "', '" . $number . "', '" . $tel . "', '" . $name . "', '" . $coment . "', '" . $email . "');");
            return true;
        }
        return false;


        $mysql->close();
    }
}

