	<!-- Load head & foot (html,body,link,meta) at view-> render -->
	
	<!--  LOAD HEADLINE -->
	<?php include_once 'html/headline.php'?>

	<!--  LOAD CONTENT -->
	<div id="content-box">
		<?php require_once $this->_loadContentPath;?>
	</div>


