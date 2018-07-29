<?php declare(strict_types = 1);

namespace Tests;

/**
 * Test: ReCaptchaResponse
 */

use Contributte\ReCaptcha\ReCaptchaResponse;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

test(function (): void {
	$response = new ReCaptchaResponse(true);
	Assert::true($response->isSuccess());
});

test(function (): void {
	$response = new ReCaptchaResponse(true);
	Assert::equal('1', (string) $response);
});

test(function (): void {
	$error = ['Some error'];
	$response = new ReCaptchaResponse(false, $error);
	Assert::false($response->isSuccess());
	Assert::equal($error, $response->getErrors());
});
