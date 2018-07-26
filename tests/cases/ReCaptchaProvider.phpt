<?php declare(strict_types = 1);

namespace Tests;

/**
 * Test: ReCaptchaProvider
 */

use Contributte\ReCaptcha\ReCaptchaProvider;
use Contributte\ReCaptcha\ReCaptchaResponse;
use Nette\Forms\Controls\BaseControl;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

final class ControlMock extends BaseControl
{

	public function getValue(): string
	{
		return 'test';
	}

}

test(function (): void {
	$key = 'key';
	$validator = new ReCaptchaProvider($key, null);

	$response = $validator->validate('test');
	Assert::type(ReCaptchaResponse::class, $response);

	Assert::false($response->isSuccess());
	Assert::notEqual(null, $response->getError());
});

test(function (): void {
	$key = 'key';
	$validator = new ReCaptchaProvider($key, null);

	Assert::false($validator->validateControl(new ControlMock()));
});

test(function (): void {
	$key = 'key';
	$validator = new ReCaptchaProvider($key, null);

	Assert::false($validator->validateControl(new ControlMock()));
});
