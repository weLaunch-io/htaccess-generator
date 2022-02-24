<?
	if(isset($flash['messages']['return'])){
		if($flash['messages']['return'] === "0"){ 
?>
			<div class="col-sm-12">
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<? 					
					echo implode("<br/>", $flash['messages']['message']);
?>
				</div>
			</div>
<?
		}
		elseif($flash['messages']['return'] ===  "1") {
?>
			<div class="col-sm-12">
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<? 					
					echo implode("<br/>", $flash['messages']['message']);
?>
				</div>
			</div>
<?
		}
	}
?>