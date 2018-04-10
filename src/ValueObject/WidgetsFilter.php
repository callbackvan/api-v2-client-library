<?php

namespace CallbackHunterAPIv2\ValueObject;

/**
 * Объект для фильтрации виджетов при получении списка
 *
 * Class WidgetsFilter
 *
 * @package CallbackHunterAPIv2\ValueObject
 */
class WidgetsFilter implements WidgetsFilterInterface
{
    /** @var integer[] */
    private $accountsIds;

    /** @var string[] */
    private $accountsSAPUUIDs;

    /**
     * @param integer[] $accountsIds
     */
    public function setAccountsIds(array $accountsIds)
    {
        $this->accountsIds = array_map('intval', $accountsIds);
    }

    /**
     * @param string[] $accountsSAPUUIDs
     */
    public function setAccountsSAPUUIDs(array $accountsSAPUUIDs)
    {
        $this->accountsSAPUUIDs = $accountsSAPUUIDs;
    }

    public function toArray()
    {
        $result = [];

        if ($this->accountsIds) {
            $result['accountId'] = $this->accountsIds;
        }

        if ($this->accountsSAPUUIDs) {
            $result['accountSAPUUID'] = $this->accountsSAPUUIDs;
        }

        return $result;
    }
}
