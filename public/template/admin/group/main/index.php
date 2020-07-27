<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<?php echo $this->_meta;?>
    <?php echo $this->_title;?>
    <?php echo $this->_css;?>
    <?php echo $this->_js;?>
</head>
<body>
	<!--  LOAD Header -->
	<?php include_once 'html/header.php'; ?>

	<!--  LOAD CONTENT -->
	<div id="content-box">
		<?php require_once $this->_loadContentPath;?>
	</div>

	<!--  LOAD Footer -->
	<?php include_once 'html/footer.php'; ?>
</body>
</html>
