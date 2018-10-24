<?php

namespace Contributte\ReCaptcha\Forms;

use Contributte\ReCaptcha\ReCaptchaProvider;
use http\Exception\BadMessageException;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Form;
use Nette\InvalidStateException;
use Nette\Utils\Html;

/**
 * @author Milan Felix Sulc <sulcmil@gmail.com> | Jan Galek <jan.galek@troia-studio.cz>
 */
class InvisibleReCaptchaField extends HiddenField
{

	/** @var ReCaptchaProvider */
	private $provider;

	/** @var bool */
	private $configured = false;

	/**
	 * @param ReCaptchaProvider $provider
	 * @param string $message
	 */
	public function __construct(ReCaptchaProvider $provider, $message = null)
	{
		parent::__construct();
		$this->provider = $provider;

		$this->setOmitted(true);
		$this->control = Html::el('div');
		$this->control->addClass('g-recaptcha');

		if ($message !== null) {
			$this->setMessage($message);
		}
	}

	/**
	 * Parse code from form data
	 *
	 * @return void
	 */
	public function loadHttpData(): void
	{
		parent::loadHttpData();
		$this->setValue($this->getForm()->getHttpData(Form::DATA_TEXT, ReCaptchaProvider::FORM_PARAMETER));
	}

	/**
	 * @param string $message
	 * @return static
	 */
	public function setMessage($message)
	{
		if ($this->configured === true) {
			throw new InvalidStateException('Please call setMessage() only once or don\'t pass $message over addInvisibleReCaptcha()');
		}

		$this->addRule(function ($code) {
			return $this->verify() === true;
		}, $message);

		$this->configured = true;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function verify()
	{
		return $this->provider->validateControl($this) === true;
	}

	/**
	 * Create control
	 *
	 * @param string $caption
	 * @return Html
	 */
	public function getControl($caption = null): Html
	{
		$el = parent::getControl();
		$el->addAttributes([
			'data-sitekey' => $this->provider->getSiteKey(),
			'data-size' => 'invisible',
		]);

		return $el;
	}
}
