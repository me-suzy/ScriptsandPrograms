<?php /* Smarty version 2.6.5-dev, created on 2005-02-17 16:59:10
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'header.tpl', 5, false),)), $this); ?>
<html>
<head>
	<title><?php if ($this->_tpl_vars['calcname']):  echo $this->_tpl_vars['calcname']; ?>
 - <?php endif; ?>Mortgage Calculators</title>
	<meta name="keywords" content="mortgage calculators">
	<meta name="description" content="<?php echo ((is_array($_tmp=@$this->_tpl_vars['calcname'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Online mortgage calculators collection.') : smarty_modifier_default($_tmp, 'Online mortgage calculators collection.')); ?>
">
	<meta http-equiv="author" content="http://www.mortgagecalculatorsplus.com/">
	<link href="calculators.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="calculators.js"></script>
</head>
<body><div id="tiplayer"></div>
