<?php

	/**
	* 
	*/
	class formmaker implements iformmaker{
		
		private $form="";

		function __construct($method,$action){
			$this->form = '<form name="editDivPage" method="'.$method.'" action="'.$action.'">';
		}
		//WIP: prossimamente array di array in $arrayString e $name array di label per opt
		public function makeOptList($arrayString,$nameLabel,$nameOpt){
			$Opt = '<select name='.$nameOpt.'><optgroup label="'.$nameLabel.'">';
			foreach ($arrayString as $string) {
				$Opt.='<option value="'.$string.'">'.$string.'</option>';
			}
			$Opt.="</optgroup></select>";
			$this->form.=$Opt;
		}
		public function insertText($text){
			$this->form .= $text;
		}
		public function makeTextAreaList($listTexts,$listIds){ //Bug da fixare[modificare poi formManager una volta fatto]:nel name oltre all'id dato c'è sempre un " rows" da capire perchè
			$txtArea = "";
			if(is_array($listIds)){
				for ($i=0; $i < count($listIds); $i++) { 
					$txtArea .= '<textarea name="'.$listIds[$i].' rows="20" cols="40">'.$listTexts[$i].'</textarea>'; 
				}
			}else{
				$txtArea .= '<textarea name="'.$listIds.' rows="20" cols="40">'.$listTexts.'</textarea>';
			}
			$this->form.=$txtArea;
		}
		
		public function insertTextBox($id){
			$this->form.='<input type="text" name="'.$id.'"></input>';
		}
		public function insertButtom($type,$name){
			$this->form.='<input type="'.$type.'" name="'.$name.'"></input>';
		}
		public function getForm(){
			return $this->form.'</form>';
		}
	}
	
?>