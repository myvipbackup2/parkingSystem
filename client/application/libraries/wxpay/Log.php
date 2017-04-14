<?php
//以下为日志

class Log
{
	private $_CI;
	private $handle = null;
	public function __construct()
	{
		$this->_CI =& get_instance();
		$this->_CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}
	public function index($file = '')
	{
		$this->handle = fopen($file,'a');
	}
	public function write($msg)
	{
		fwrite($this->handle, $msg, 4096);
	}
	
	public function __destruct()
	{
		fclose($this->handle);
	}
}

