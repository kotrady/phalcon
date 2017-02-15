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
        <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
?>
    </head>
    <body>
<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>            <span><?php echo LR\Filters::escapeHtmlText($flash->type) /* line 8 */ ?></span>
            <span><?php echo LR\Filters::escapeHtmlText($flash->message) /* line 9 */ ?></span>
<?php
			$iterations++;
		}
?>

        <?php
		$this->renderBlock('content', get_defined_vars());
		?>        <?php
		$this->renderBlock('js', get_defined_vars());
?>
    </body>
</html><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 7');
		
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
