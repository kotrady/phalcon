<?php
// source: D:\Xampp\htdocs\ja\b\bartonline/app/views/homepage.latte

use Latte\Runtime as LR;

class Template4490d75e7e extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'js' => 'blockJs',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'css' => 'html',
		'js' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
		$this->renderBlock('js', get_defined_vars());
?>

<?php
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '_layout.latte';
		
	}


	function blockCss($_args)
	{
		
	}


	function blockJs($_args)
	{
		
	}


	function blockContent($_args)
	{
		
	}

}
