<?php 

namespace start\database;
use \PDO;

class Connection
{
	private static Connection $instance;
	private $pdo;
	private $dsn;
	private $username;
	private $password;
	private $options;

	private function __construct()
	{
		$config = config("database");

		// kiểm tra cấu hình không rỗng
		if (empty($config)) {
			die("not found config");
		}

		$this->dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=" . $config['charset'];

		$this->username = $config['username'];
		$this->password = $config['password'];
		$this->options  = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

		echo $this->dsn;
	}


	public static function get_instance()
	{
		if (! isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	public function connect()
	{
		if (! isset($this->pdo)) {
			try {
				$this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
				echo "create";
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		echo "use";
		return $this->pdo;
	}


	public function close()
	{
		$this->pdo = null;
		var_dump($this->pdo);
	}
}