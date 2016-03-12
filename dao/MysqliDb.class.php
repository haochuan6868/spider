<?php
/**
 * Created by PhpStorm.
 * User: haochuan
 * Date: 2016/3/10
 * Time: 16:27
 */
class MysqliDb
{
    private static $_interface = null;
    private $host;
    private $user;
    private $pass;
    private $data;
    private $port;
    public $conn;
    private $rs_type = MYSQLI_ASSOC;

    private function __construct($config = array())
    {
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->data = $config['data'];
        $this->port = $config['port'];
        $this->conn = mysqli_connect($this->host,$this->user,$this->pass,$this->data,$this->port);
        if(!$this->conn){
            return false;
        }
    }
    private function __clone()
    {

    }

    public static function getInterface($config)
    {
        if(self::$_interface === null){
            self::$_interface = new MysqliDb($config);
        }
        return self::$_interface;
    }

    public function query($sql)
    {
        $result = mysqli_query($this->conn,$sql);
        if(!$result){
            return false;
        }
        return $result;
    }
    public function getAll($sql = "", $primary = "")
    {
        $result = $this->query($sql);
        if(!$result) {
            return false;
        }
        while ($rows = mysqli_fetch_array($result, $this->rs_type)) {
            if($primary && $rows[$primary]) {
                $rs[$rows[$primary]] = $rows;
            } else {
                $rs[] = $rows;
            }
        }
        return (isset($rs) ? $rs : false);
    }
    public function getOne($sql = "")
    {
        $result = $this->query($sql);
        if(!$result) {
            return false;
        }
        $rows = mysqli_fetch_array($result, $this->rs_type);
        return $rows;
    }
    public function insertId()
    {
        return mysqli_insert_id($this->conn);
    }
}