<?php declare(strict_types = 1);

namespace Contributte\ReCaptcha\Forms;

use Contributte\ReCaptcha\ReCaptchaProvider;
use Nette\Forms\Container;

final class ReCaptchaBinding
{

	public static function bind(ReCaptchaProvider $provider, string $name = 'addReCaptcha'): void
	{
		// Bind to form container
		Container::extensionMethod($name, function ($container, $name = 'recaptcha', $label = 'ReCaptcha', $required = true, $message = null) use ($provider) {
			$field = new ReCaptchaField($provider, $label, $message);
			$field->setRequired($required);
			$container[$name] = $field;

			return $container[$name];
		});
	}

}
