<?php

use Yosymfony\Toml\Toml;

class Configuration
{
	private $isLoaded = false;
	private $config;
	
	public function LoadConfig($file)
	{
		try
		{
			$this->config = Toml::ParseFile(DIR_FREEPOD . $file);
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		$this->validateConfig();
	}

	public function GetTitle(){
		if (!$this->isLoaded) throw new Exception('Config has not been loaded.');
		return $this->config['title'];
	}

	public function GetDescription(){
		if (!$this->isLoaded) throw new Exception('Config has not been loaded.');
		return $this->config['about']['description'];
	}

	public function GetEmail(){
		if (!$this->isLoaded) throw new Exception('Config has not been loaded.');
		return $this->config['about']['email'];
	}

	public function GetURL(){
		if (!$this->isLoaded) throw new Exception('Config has not been loaded.');
		return $this->config['website']['url'];
	}

	public function GetDebug(){
		if (!$this->isLoaded) throw new Exception('Config has not been loaded.');
		return $this->config['website']['debug'];
	}

	private function validateConfig()
	{
		try
		{
			// TODO: Validate & Sanitize config data.
			$this->isLoaded = true;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}


?>