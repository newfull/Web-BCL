<?php
class hinhtron{
	private $r;

	public function hinhtron(){
		$this->r = 0;
	}

	public function GanR($R){
		$this->r = $R;
	}

	public function DienTich(){
		return $this->r*$this->r*pi();
	}

	public function ChuVi(){
		return 2*$this->r*pi();
	}

	public function getR(){
		return $this->r;
	}
}
?>
