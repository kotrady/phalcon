<?php
// source: D:\Xampp\htdocs\learn\phalcon\app\views\_layout.latte

use Latte\Runtime as LR;

class Template0a52f17540 extends Latte\Runtime\Template
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
        <title>VirConsil Club</title>
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 4 */ ?>/public/semantic/semantic.css">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 5 */ ?>/public/themes/style.css" media="screen">
        <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>
    </head>
    <body>
        <?php
		$this->renderBlock('content', get_defined_vars());
		?>        <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 10 */ ?>/public/semantic/semantic.js"></script>
        <?php
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
