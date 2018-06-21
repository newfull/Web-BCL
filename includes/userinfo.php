<?
require_once 'functions.php';

class bclUser{
  private $conn;
  private $iAccountId = "";
  private $sAccountName = "";
  private $sAccountEmail = "";
  private $sAccountPhone = "";
  private $sAccountSex = "";
  private $sAccountAdd = "";
  private $sAccountDOB = "";
  private $sAccountNoti = "";
  private $sLikedItems = "";
  private $sLikedCombos = "";
  private $iCartId = "";

  public function bclUser($conn){
    $this->conn = $conn;
  }

  public function init_info($id){
    if($id != 0)
    {
      $row = user_info($this->conn, $id)[0];
      $this->setID($id);
      $this->setName($row['ACCOUNTNAME']);
      $this->setLiked($row['ACCOUNTLIKEDITEMS']);
      $this->setComboLiked($row['ACCOUNTLIKEDCOMBOS']);
      $this->setEmail($row['ACCOUNTEMAIL']);
      $this->setPhone($row['ACCOUNTPHONE']);
      $this->setSex($row['ACCOUNTSEX']);
      $this->setAdd($row['ACCOUNTADD']);
      $this->setDOB($row['ACCOUNTDOB']);
      $this->setNoti($row['ACCOUNTNOTI']);
      $this->setCart(init_cart($this->conn, $id));
    }
  }

    private function setID($val) {
      $this->iAccountId = $val;
    }
    private function setName($val) {
      $this->sAccountName = shorten_string($val);
    }
    private function setEmail($val) {
      $this->sAccountEmail = $val;
    }
    private function setPhone($val) {
      $this->sAccountPhone = $val;
    }
    private function setSex($val) {
      $this->sAccountSex = $val;
    }
    private function setAdd($val) {
      $this->sAccountAdd = $val;
    }
    private function setDOB($val) {
      $this->sAccountDOB = $val;
    }
    private function setNoti($val) {
      $this->sAccountNoti = $val;
    }
    private function setLiked($val) {
      $this->sLikedItems = $val;
    }
    private function setComboLiked($val) {
      $this->sLikedCombos = $val;
    }
    private function setCart($val) {
      $this->iCartId = $val;
    }


    public function getID() {
      return $this->iAccountId;
    }
    public function getName() {
      return $this->sAccountName;
    }
    public function getEmail() {
      return $this->sAccountEmail;
    }
    public function getPhone() {
      return $this->sAccountPhone;
    }
    public function getSex() {
      return $this->sAccountSex;
    }
    public function getAdd() {
      return $this->sAccountAdd;
    }
    public function getDOB() {
      return $this->sAccountDOB;
    }
    public function getNoti() {
      return $this->sAccountNoti;
    }
    public function getLiked() {
      return $this->sLikedItems;
    }
    public function getComboLiked() {
      return $this->sLikedCombos;
    }
    public function getCart() {
      return $this->iCartId;
    }


  public function __set($name,$value) {
    switch($name) {
      case 'iAccountId':
        return $this->setID($value);
        break;
      case 'sAccountName':
        return $this->setName($value);
        break;
      case 'sAccountEmail':
        return $this->setEmail($value);
        break;
      case 'sAccountPhone':
        return $this->setPhone($value);
        break;
      case 'sAccountSex':
        return $this->setSex($value);
        break;
      case 'sAccountAdd':
        return $this->setAdd($value);
        break;
      case 'sAccountDOB':
        return $this->setDOB($value);
        break;
      case 'sAccountNoti':
        return $this->setNoti($value);
        break;
      case 'sLikedItems':
        return $this->setLiked($value);
        break;
      case 'sLikedCombos':
        return $this->setComboLiked($value);
        break;
      case 'iCartId':
        return $this->setCart($value);
        break;
    }
  }

  public function __get($name) {
    switch($name) {
      case 'iAccountId':
        return $this->getID();
        break;
      case 'sAccountName':
        return $this->getName();
        break;
      case 'sAccountEmail':
        return $this->getEmail();
        break;
      case 'sAccountPhone':
        return $this->getPhone();
        break;
      case 'sAccountSex':
        return $this->getSex();
        break;
      case 'sAccountAdd':
        return $this->getAdd();
        break;
      case 'sAccountDOB':
        return $this->getDOB();
        break;
      case 'sAccountNoti':
        return $this->getNoti();
        break;
      case 'sLikedItems':
        return $this->getLiked();
        break;
      case 'sLikedCombos':
        return $this->getComboLiked();
        break;
      case 'iCartId':
        return $this->getCart();
        break;
    }
  }
};

?>
