<?php
// source: D:\Xampp\htdocs\ja\b\bartonline\app\views\_layout.latte

use Latte\Runtime as LR;

class Template4e7b33afbf extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'content' => 'blockContent',
		'js' => 'blockJs',
	];

	public $blockTypes = [
		'css' => 'html',
		'content' => 'html',
		'js' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<html>
    <head>
        <title>bart online v2.0</title>
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 4 */ ?>/public/css/core.css">
        <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>
    </head>
    <body>
        <?php
		$this->renderBlock('content', get_defined_vars());
		?>        <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 9 */ ?>/public/jquery/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 10 */ ?>/public/js/core.js"></script>
<?php
		if ($flashes) {
			?>            <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 12 */ ?>/public/js/flash.js"></script>
<?php
		}
		?>        <?php
		$this->renderBlock('js', get_defined_vars());
?>
    </body>
</html><?php
		return get_defined_vars();
	}


	function blockCss($_args)
	{
		
	}


	function blockContent($_args)
	{
		
	}


	function blockJs($_args)
	{
		
	}

}
