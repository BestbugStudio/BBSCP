<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
	
	function sendResponse($validMessage,$invalidMessage,$data,$expectedBool){
		
		if($expectedBool)
			$cond = ($res==1);
		else
			$cond = ($res != null || $res != "" || !empty($res));

		if($cond){
			$response = array(
				'Status'	=> 'OK',
				'Message'	=> $validMessage,
				'Data'		=> $data
			);
			return json_encode($response);
		}

		$response = array(
			'Status'	=> 'KO',
			'Reason'	=> $invalidMessage
		);
		return json_encode($response);
	}

	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>