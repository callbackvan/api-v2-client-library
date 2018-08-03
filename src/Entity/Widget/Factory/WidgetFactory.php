<?php

namespace CallbackHunterAPIv2\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Collection\PhonesCollection;
use CallbackHunterAPIv2\Entity\Widget\Phone\Factory\PhoneFactory;
use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory;
use CallbackHunterAPIv2\Entity\Widget\Widget;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;

class WidgetFactory implements BaseFactoryInterface, WidgetFactoryInterface
{
    /**
     * @var SettingsFactory
     */
    private $settingsFactory;

    /**
     * @var PhoneFactory
     */
    private $phoneFactory;

    /**
     * WidgetFactory constructor.
     *
     * @param SettingsFactory  $settingsFactory
     * @param PhoneFactory     $phoneFactory
     */
    public function __construct(
        SettingsFactory $settingsFactory,
        PhoneFactory $phoneFactory
    ) {
        $this->settingsFactory = $settingsFactory;
        $this->phoneFactory = $phoneFactory;
    }

    /**
     * @param array $data
     *
     * @return WidgetInterface
     * @throws \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function fromAPI(array $data)
    {
        $settings = $this->settingsFactory->fromAPI(
            isset($data['settings']) ? $data['settings'] : []
        );

        $phoneCollection = new PhonesCollection;

        if (!empty($data['_embedded']['phones'])) {
            foreach ($data['_embedded']['phones'] as $phone) {
                $phoneCollection->attach($this->phoneFactory->fromAPI($phone));
            }
        }

        $widget = new Widget($settings, $phoneCollection);

        foreach ($data as $k => $v) {
            $setterMethod = 'set'.ucfirst($k);

            if (!method_exists($widget, $setterMethod)) {
                continue;
            }

            $widget->{$setterMethod}($v);
        }

        if (!empty($data['_links']['widgetSettings']['href'])) {
            $widget->setWidgetSettingsLink(
                $data['_links']['widgetSettings']['href']
            );
        }

        if (!empty($data['_links']['operatorChat']['href'])) {
            $widget->setOperatorChatLink(
                $data['_links']['operatorChat']['href']
            );
        }

        return $widget;
    }
}
