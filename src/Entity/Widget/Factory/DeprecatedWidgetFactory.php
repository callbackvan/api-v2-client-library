<?php

namespace CallbackHunterAPIv2\Entity\Widget\Factory;

use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidget;
use CallbackHunterAPIv2\Entity\Widget\DeprecatedWidgetInterface;

class DeprecatedWidgetFactory implements BaseFactoryInterface, WidgetFactoryInterface
{
    /**
     * @param array $data
     *
     * @return DeprecatedWidgetInterface
     * @throws \CallbackHunterAPIv2\Exception\InvalidArgumentException
     */
    public function fromAPI(array $data)
    {
        $widget = new DeprecatedWidget();

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

        return $widget;
    }
}
