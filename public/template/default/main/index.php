<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<?php echo $this->_meta;?>
    <?php echo $this->_title;?>
    <?php echo $this->_css;?>
    <?php echo $this->_js;?>
</head>
<body>
	<div id="content-box">
		<!--  LOAD CONTENT -->
		<?php
		echo 'Load content';
			require_once $this->_loadContentPath;
		?>
	</div>
	<div id="footer">
		<p class="copyright">
        	<h3>Template default</h3>	
		</p>
	</div>
</body>
</html>