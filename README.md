# CallbackHunter APIv2 Client Library
Официальная библиотека для APIv2 CallbackHunter.

### Status
[![Build Status](https://travis-ci.org/callbackvan/api-v2-client-library.svg?branch=master)](https://travis-ci.org/callbackvan/api-v2-client-library)
[![Coverage Status](https://coveralls.io/repos/github/callbackvan/api-v2-client-library/badge.svg)](https://coveralls.io/github/callbackvan/api-v2-client-library)


Документацию по доступным методам можно найти по [ссылке](https://developers.callbackhunter.com)

_*Внимание!*_ API находится в стадии разработки.

## Installation
Для того, чтобы подключить библиотеку в свой проект, можно воспользоваться [composer](https://getcomposer.org)

```bash
composer require callbackhunter/apiv2library
```

## Usage
Примеры использования

```php
use CallbackHunterAPIv2\MainFactory;
use CallbackHunterAPIv2\ValueObject\Pagination;
use CallbackHunterAPIv2\Entity\Widget\Settings\Images\ButtonLogoImage;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\ImageForUploadFactory;

$userId = 123;
$key = md5('test');

$pagination = new Pagination;
$repository = MainFactory::makeWidgetRepositoryFactory()->make($userId, $key);
while ($widgets = $repository->getList($pagination)) {
    $pagination->nextPage();
    foreach ($widgets as $widget) {
        if ($widget->isActive()) {
            $widget->setIsActive(false);
            $repository->save($widget);
        }
    }
}

try {
    $uploadFactory = new ImageForUploadFactory;
    $buttonLogo = new ButtonLogoImage;
    $image = $uploadFactory->createFromPath('path/to/image.png');
    $buttonLogo->setForUpload($image);

    $widget = $repository->get('my widget uid');
    $widget->getSettings()->getImages()->setButtonLogo($buttonLogo);
    $repository->save($widget);
} catch (\CallbackHunterAPIv2\Exception\ChangeOfPaidPropertiesException $e) {
    echo 'You must pay for change: ', implode(array_keys($e->getInvalidParams()));
} catch (\CallbackHunterAPIv2\Exception\ResourceNotFoundException $e) {
    echo 'Widget not found';
} catch (\CallbackHunterAPIv2\Exception\WidgetValidateException $e) {
    echo 'You trying to upload not an image';
} catch (\CallbackHunterAPIv2\Exception\Exception $e) {
    echo 'API Error: ' . $e->getMessage();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    echo 'HTTP Exception: ' . $e->getMessage();
}
```
