
<div class="container mt-5 mb-5">
    <nav class = 'row text-secondary mb-3'>
        <h2 class='col-6'><?php echo $this->_headline;?></h2>
        <div class='col-6'>
            <?php $this->_arrParam['action'] != 'index'? include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'select-tool'.DS.'index.php':null?>
        </div>
    </nav>
</div>