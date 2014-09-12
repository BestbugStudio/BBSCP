<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
	
	function sendResponse($validMessage,$invalidMessage,$data,$expectedData){
		
		if($expectedData)
			$cond = ($data==1);
		else
			$cond = ($data != null || $data != "" || !empty($data));

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