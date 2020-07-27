	<!-- Load head & foot (html,body,link,meta) at view-> render -->
	
	<!--  LOAD Header -->
	<?php include_once 'html/header.php'; ?>

	<!--  LOAD CONTENT -->
	<div id="content-box">
		<?php require_once $this->_loadContentPath;?>
	</div>

	<!--  LOAD Footer -->
	<?php include_once 'html/footer.php'; ?>

