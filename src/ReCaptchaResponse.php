<?php declare(strict_types = 1);

namespace Contributte\ReCaptcha;

final class ReCaptchaResponse
{

	// Error code list
	public const ERROR_CODE_MISSING_INPUT_SECRET = 'missing-input-secret';
	public const ERROR_CODE_INVALID_INPUT_SECRET = 'invalid-input-secret';
	public const ERROR_CODE_MISSING_INPUT_RESPONSE = 'missing-input-response';
	public const ERROR_CODE_INVALID_INPUT_RESPONSE = 'invalid-input-response';
	public const ERROR_CODE_UNKNOWN = 'unknow';

	/** @var bool */
	private $success;

	/** @var string[] */
	private $errors;

	/**
	 * @param string[] $errors
	 */
	public function __construct(bool $success, ?array $errors = [])
	{
		$this->success = $success;
		$this->errors = $errors;
	}

	public function isSuccess(): bool
	{
		return $this->success;
	}

	/**
	 * @return string[]
	 */
	public function getErrors(): ?array
	{
		return $this->errors;
	}

	public function __toString(): string
	{
		return (string) $this->isSuccess();
	}

}
