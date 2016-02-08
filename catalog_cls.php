<?php

class catalog_cls{

	public $aname;
	public $config;
	public $price;
	public $status;

	public function setAname($aname){
	    $this->aname=$aname;
	}

	public function setConfig($config){
	    $this->config=$config;
	}

	public function setPrice($price){
	    $this->price=$price;
	}

	public function setStatus($status){
	    $this->status=$status;
	}

	public function getAname(){
	    return $this->aname;
	}

	public function getConfig(){
	    return $this->config;
	}

	public function getPrice(){
	    return $this->price;
	}

	public function getStatus(){
	    return $this->status;
	}
}
?>