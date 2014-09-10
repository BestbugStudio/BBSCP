<?php
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

Class PrintTable{

	private $tabletitle, $valarr, $numOfFields, $optarr, $editlink, $removelink;
	private $columnTitles = "";
	private $values = "";

	public function __construct($title, $valuesArray, $numberOfFields, $optarr, $editlink, $removelink){

		$this->tabletitle = $title;
		$this->valarr = $valuesArray;
		$this->numOfFields = $numberOfFields;
		$this->optarr = $optarr;
		$this->editlink = $editlink;
		$this->removelink = $removelink;

		if(count($valuesArray)==0){
			echo '<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10"><h5>There are no content to show, add something new :)</h5></div>
					<div class="col-md-1"></div>
				  </div>';
			exit;
		}

		$this->generateColumnTitleRow();
		$this->generateValuesRows();
		$this->printer();
	}

	private function generateColumnTitleRow(){
		for($i=1; $i<$this->numOfFields*2; $i+=2){
			$this->columnTitles .= "<td>".$this->trimUnderScores(array_keys($this->valarr[0])[$i])."</td>";		
		}

		$this->columnTitles.='<td style="width:20px;">Edit</td><td style="width:20px;">Delete</td>';
	}

	private function generateValuesRows(){
		for($j=0; $j<count($this->valarr); $j++){
			$this->values .= '<tr id="row_'.$this->valarr[$j][0].'">';

			for($i=0; $i<$this->numOfFields; $i++){
				$this->values .= "<td>".$this->valarr[$j][$i]."</td>";
			}
			$this->values .= '<td>
							  	<a href="?'.$this->optarr.$this->editlink.$this->valarr[$j][0].'">
							  		<span id="edit_'.$this->valarr[$j][0].'" class="glyphicon glyphicon-pencil editspan"></span>
							  	</a>
							  </td>
							  <td>
							  	<a href="?'.$this->optarr.$this->removelink.$this->valarr[$i][0].'">
							  		<span id="remove_'.$this->valarr[$j][0].'" class="glyphicon glyphicon-remove removespan"></span>
							  	</a>
							  </td>
							</tr>';
		}

		//<a href="?f=edit.php&'.$this->trimUnderScores(array_keys($this->valarr[0])[1]).'='.$this->valarr[$j][0].'"><span id="edit_'.$this->valarr[$j][0].'" class="glyphicon glyphicon-pencil editspan"></span></a>
	}

	private function printer(){
		echo '
		<div class="col-md-1"></div>
		<div class="panel panel-default tablepanel col-md-10">
			<div class="panel-heading tabletitle">'.$this->tabletitle.'</div>
			
			<table class="table">
				<tr class="colTitles">
					'.$this->columnTitles.'
				</tr>
					'.$this->values.'
			</table>
		</div>
		<div class="col-md-1"></div>';
	}

	private function trimUnderScores($stringtotrim){
		return str_replace("_", " ", $stringtotrim);
	}
}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>