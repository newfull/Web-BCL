<?php
include 'hinhtron.php';

class hinhtrutron extends hinhtron{
	private $h;

	public function hinhtrutron(){
		$this->r = 0;
    $this->h = 0;
	}

	public function GanR($R){
		$this->r = $R;
	}

  public function GanH($H){
		$this->h = $H;
	}

  public function Gan($R, $H){
      $this->GanR($R);
      $this->GanH($H);
  }

    public function getR(){
      return $this->r;
    }


      public function getH(){
        return $this->h;
      }

  public function DienTichDay(){
    return $this->r*$this->r*pi();
  }

  public function ChuViDay(){
    return 2*$this->r*pi();
  }

	public function TheTich(){
		return $this->DienTichDay()*$this->h;
	}

	public function DTXQ(){
		return ($this->ChuViDay()*$this->h);
	}

  public function DTTP(){
		return ($this->DienTichDay()*2)+$this->DTXQ();
	}
}

?>
