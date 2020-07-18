<?php namespace App\Models;

class Cg{
  static $nums = "/^[0-9]+$/i";
  static $words = "/^[a-zñÑáéíóúÁÉÍÓÚüÜ ]+$/i";
  static $text = "/^[a-zñÑáéíóúÁÉÍÓÚüÜ. ]+$/i";
  static $alphanums = "/^[0-9a-zñÑáéíóúÁÉÍÓÚüÜ. ]+$/i";
  static $email = "/^[a-z]+[a-z_\.\-0-9]+@[a-z]+\.[a-z]{2,5}$/i";
  static $range = "/^[0-9]+[ ]{0,1}\-[ ]{0,1}[0-9]+$/i";
  static $bits = "/^[0-1]$/i";
  static $fecha = "/^(19|20)[0-9]{2}-[0-9]{2}-[0-9]{2}$/i";
  static $class = "/\.[\-\da-z_]+/i";
  static $id = "/\#[\-\da-z_]+/i";

  // NOTE: liempiar los attr que tiene chars repetidos
  static $attr = "/([\w]+[\w\d_\-][ ]*=[ ]*'[\/\\\?\+\&#,=ñÑ\d%\w\";.\-_:\{\}\[\] \(\)]*'|[\w]+[\w\d_\-]+[ ]*=[ ]*\"[\/\\\?\+\&#,=ñÑ\d%\w';.\-_:\{\}\[\] \(\)]*\")/i";
  public static function attr($attr){
    return $regex = "/($attr+[ ]*=[ ]*'[\/\\\?\+\&#,=ñÑ\d%\w\";.\-_:\{\}\[\] \(\)]*'|$attr+[ ]*=[ ]*\"[\/\\\?\+\&#,=ñÑ\d%\w';.\-_:\{\}\[\] \(\)]*\")/i";
  }

  function validar($var,$regex){
    if (gettype($var) !== "NULL") {
      if (preg_match($regex, $var)) {return "ES VALIDO";}
    }
    return "NO ES VALIDO(".$var.")";
  }

  public static function validator(){
    return new CgValidator();
  }
  public static function evaluator($value){
    return new CgEvaluator($value);
  }



}
class CgEvaluator{
	public $value = "";
	private $validations = ["novalues" => null, "novoid" => false, "regex" => null, "dimension" => null, "range" => null,"equalvalues"=>null];
	private $keyvalidations = ["novalues", "novoid", "regex", "dimension", "range", "equalvalues"];
	private $typeError = "NO ERROR DETECTED";
	function __construct($value){
		$this -> value = $value;
	}
	function getTypeError(){
		return $this->typeError;
	}

	function validation($setvalidation){

		foreach ($setvalidation as $key => $value) {
			if (in_array($key,$this -> keyvalidations)) {
				$this -> validations[$key] = $setvalidation[$key];
			}
		}
		return $this;
	}
	function isValid(){
		$valid = true;

		if (!is_null($this -> validations["novalues"])) {
			$valid = !in_array($this -> value, $this -> validations["novalues"]);
			$this -> typeError = "value no accepted";
		}
		if ($valid) {
			if ($this -> validations["novoid"]) {
				$valid = strlen($this -> value) > 0;
				$this -> typeError = "value is void";
			}
		}

		if ($valid) {
			if (!is_null($this -> validations["regex"])) {
				if (strlen($this -> value) > 0 && !is_null($this -> value)) {
					$valid = preg_match($this -> validations["regex"], $this -> value) ? true: false;
				}
				$this -> typeError = "incorrect format";
			}
		}

		if ($valid) {
			$dimension = $this -> validations["dimension"];
			if (!is_null($dimension)) {
				$valDim = false;
				$dimvalue = strlen($this -> value);
				//$valid = in_array(strlen($this -> value), $dimension);
				foreach ($dimension as $key => $value) {
					if (gettype($value) === "integer") {
						$valDim |= $dimvalue === $value;
					}
					if (gettype($value) === "string") {
						if (is_numeric($value)) {
							$valDim |= $dimvalue === intval($value);
						}else {
							if (preg_match(Cg::$range,$value)) {
								$arrg = preg_split("/\-/i",$value);
								$arrg[0] = intval($arrg[0]);
								$arrg[1] = intval($arrg[1]);
								$valDim |= $dimvalue >= $arrg[0] && $dimvalue <= $arrg[1];
							}
						}
					}
				}
				$valid = $valDim;
				$this -> typeError = "incorrect dimension";
			}
		}
		if ($valid) {
			$range = $this -> validations["range"];
			if (!is_null($this -> validations["range"])) {
				$this -> typeError = "out range";
				if (is_numeric($this -> value)) {
					$temp = floatval($this -> value);
					$valid = $temp >= $range[0] && $temp <= $range[1];
				}
				else {
					$valid = false;
				}
			}
		}
		if ($valid) {
			if (!is_null($this -> validations["equalvalues"])) {
				$valid = in_array($this -> value, $this -> validations["equalvalues"]);
				$this -> typeError = "value no accepted";
			}
		}
		if($valid) $this -> typeError = "NO ERROR DETECTED";
		return $valid;
	}

}
class CgValidator{
	public $error = ["value" => [], "description" => [], "desc_error" => []];
	public $allvalid = true;

	function onlyError(){
		$error = ["value" => [], "description" => []];
		foreach ($this -> error["description"] as $key => $value) {
			if ($value !== "IS_VALID") {
				array_push($error["value"],$this -> error["value"][$key]);
				array_push($error["description"],$value);
			}
		}
		return $error;
	}
	function addValue($value,$validator,$name = NULL){
		$name = is_null($name) ? $value : $name;
		$val = new CgEvaluator($value);
		$val -> validation($validator);
		$valev = $val -> isValid();
		$desc = ($valev ? "IS_VALID": "NO_IS_VALID(".$val->value.")");
		array_push($this->error["value"], $name);
		array_push($this->error["description"], $desc);
		array_push($this->error["desc_error"], $val->getTypeError());
		$this -> allvalid &= $valev;


		return $this;
	}
}
