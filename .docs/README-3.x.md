# reCAPTCHA 3.x

## Installation

```sh
composer require contributte/recaptcha
```

## Configuration

```yaml
extensions:
    recaptcha: Contributte\ReCaptcha\DI\ReCaptchaExtension

recaptcha:
    secretKey: ***
    siteKey: ***
```

## Usage

```php
use Nette\Application\UI\Form;

protected function createComponentForm(): Form
{
    $form = new Form();

    $form->addReCaptcha('recaptcha', $label = 'Captcha')
        ->setMessage('Are you bot?');

    $form->addReCaptcha('recaptcha', $label = 'Captcha', $required = FALSE)
        ->setMessage('Are you bot?');

    $form->addReCaptcha('recaptcha', $label = 'Captcha', $required = TRUE, $message = 'Are you bot?');

    $form->onSuccess[] = function(Form $form): void {
        dump($form->getValues());
    }
}
```

## Rendering

```smarty
<form n:name="myForm">
	<div class="form-group">
		<div n:name="recaptcha"></div>
	</div>
</form>
```

Be sure you place this script before `</body>` element.

```html
<!-- re-Captcha -->
<script src='https://www.google.com/recaptcha/api.js'></script>
```
