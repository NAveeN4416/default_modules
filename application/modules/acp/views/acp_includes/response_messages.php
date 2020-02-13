<div class="col-md-10">
						<?PHP
							// when error message contain System String number
						  if(strlen($this->session->flashdata('requestMsgSucc')) && is_numeric($this->session->flashdata('requestMsgSucc'))) { 
							  $message = $this->session->flashdata('requestMsgSucc');
						?>
							<h6 class="alert alert-success text-center check_err"><?=getSystemString($message)?></h6>
							<?PHP
						           					           
						        } else if(strlen($this->session->flashdata('requestMsgErr')) && is_numeric($this->session->flashdata('requestMsgErr'))){
							         $message = $this->session->flashdata('requestMsgErr');
							        ?>
							        <h6 class="alert alert-danger text-center check_err"><?=getSystemString($message)?></h6>
							        <?PHP
								}
														     
						?>
						
						<?PHP
							// when error message contain System String number splited with new lines
						           					           
						       if(strlen($this->session->flashdata('requestMsgErr')) && !is_numeric($this->session->flashdata('requestMsgErr'))){
							        $msgs = strip_tags(str_replace('</p>', ' ', $this->session->flashdata('requestMsgErr')));
								    $msgs = explode(' ', $msgs);
								    $message = '';
							         foreach($msgs as $msg){
								         if(is_numeric($msg)) {
									 	?>
									 	 <h6 class="alert alert-danger text-center check_err"><?=getSystemString(trim($msg))?></h6>
									 	<?PHP
										 	}
							  		 }
							        ?>
							        
							        <?PHP
								}
														     
						?>
				</div>