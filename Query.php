<?php 

namespace BaseXClient;

class Query {
	/* Class variables.*/
	var $session, $id, $open;

	/* see readme.txt */
	public function __construct($s, $q) {
		$this->session = $s;
		$this->id = $this->exec(chr(0), $q);
	}

	/* see readme.txt */
	public function bind($name, $value, $type = "") {
		$this->exec(chr(3), $this->id.chr(0).$name.chr(0).$value.chr(0).$type);
	}

	/* see readme.txt */
	public function context($value, $type = "") {
		$this->exec(chr(14), $this->id.chr(0).$value.chr(0).$type);
	}

	/* see readme.txt */
	public function execute() {
		return $this->exec(chr(5), $this->id);
	}

	/* see readme.txt */
	public function info() {
		return $this->exec(chr(6), $this->id);
	}

	/* see readme.txt */
	public function options() {
		return $this->exec(chr(7), $this->id);
	}

	/* see readme.txt */
	public function close() {
		$this->exec(chr(2), $this->id);
	}

	/* see readme.txt */
	public function exec($cmd, $arg) {
		$this->session->send($cmd.$arg);
		$s = $this->session->receive();
		if($this->session->ok() != True) {
			throw new \Exception($this->session->readString());
		}
		return $s;
	}
}

?>
