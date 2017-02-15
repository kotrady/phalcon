<?php
// source: D:\Xampp\htdocs\learn\phalcon/app/views/login.latte

use Latte\Runtime as LR;

class Templateffa451703b extends Latte\Runtime\Template
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
		extract($_args);
		?>    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($WEBROOT)) /* line 5 */ ?>/public/js/login.js"></script>
<?php
	}


	function blockContent($_args)
	{
?>    <div id="login" class="ui segment">
        <form method="POST" action="login/form" class="ui form">
            <div class="panel-heading">
                <div class="resetButton"></div>
                <button type="button" class="ui button" data-name="Pacient" data-type="0">
                    <i class="fa fa-user" aria-hidden="true"></i> Pacient
                </button>
                <button type="button" class="ui vircon button" data-name="Lekár" data-type="1">
                    <i class="fa fa-stethoscope" aria-hidden="true"></i> Lekár
                </button>
                <div class="mustClick">Ste pacient alebo lekár?</div>
            </div>
            <div class="panel-body">
                <div class="field">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required="required" />
                </div>
                <div class="field">
                    <label>Heslo</label>
                    <input type="password" name="password" class="form-control" placeholder="Heslo" required="required" />
                </div>
                <label>
                    <a href="#" id="passwordForgot" title="">Zabudli ste heslo?</a>
                </label>
            </div>
            <div class="panel-footer">
                <input type="hidden" name="type" data-name="" value="" />
                <button type="button" id="newRegister" class="ui right floated button registration">Nová registrácia</button>
                <button type="submit" name="login" class="ui positive button">Prihlásiť sa</button>
            </div>
        </form>
        <a href="http://www.assistancecare.sk/virconsil-club" class="virconsilButton">VirConsil Club - Viac</a>
    </div>

    <div class="ui small modal" id="password">
        <h2 class="ui header"><i class="unlock alternate icon"></i><div class="content">Zabudnuté heslo</div></h2>
        <div class="content">
            <form class="ui form" id="password-form" method="POST" action="forgot-password">
                <div class="field">
                    <label>E-mail</label>
                    <input type="text" name="email" placeholder="E-mail" />
                </div>
            </form>
        </div>
        <div class="actions">
            <div class="ui red deny button pull-left">Zrušiť</div>
            <button type="submit" form="password-form" class="ui positive right labeled icon button">
                Overiť e-mail
                <i class="checkmark icon"></i>
            </button>
        </div>
    </div>

    <div class="ui small modal" id="registration"></div>
<?php
	}

}
