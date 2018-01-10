<?php

namespace CallbackHunterAPIv2\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Widget\Settings\Factory\SettingsFactory;
use CallbackHunterAPIv2\Entity\Widget\Widget;
use CallbackHunterAPIv2\Entity\Widget\WidgetInterface;

class WidgetFactory implements BaseFactoryInterface, WidgetFactoryInterface
{
    /**
     * @var SettingsFactory
     */
    private $settingsFactory;

    public function __construct(SettingsFactory $settingsFactory)
    {
        $this->settingsFactory = $settingsFactory;
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

        $widget = new Widget($settings);

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
