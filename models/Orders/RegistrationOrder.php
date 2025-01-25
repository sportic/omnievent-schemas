<?php

namespace Sportic\OmniEvent\Models\Orders;

use Spatie\SchemaOrg\Invoice;
use Spatie\SchemaOrg\Order;
use Spatie\SchemaOrg\OrderItem;

/**
 *
 */
class RegistrationOrder extends Order
{

    /**
     * @return Invoice|null
     */
    public function getInvoice()
    {
        return $this->getProperty('partOfInvoice');
    }

    /**
     * @param OrderItem $orderedItem
     * @return RegistrationOrder
     */
    public function orderedItem($orderedItem)
    {
        $invoice = $this->getInvoice();
        if ($invoice) {
            $totalPaymentDue = $invoice->getProperty('totalPaymentDue');
            $currency = $totalPaymentDue->getProperty('currency');
            $orderedItem = is_array($orderedItem) ? $orderedItem : [$orderedItem];
            foreach ($orderedItem as $item) {
                $orderItem = $item->getProperty('orderedItem');
                $orderItem->setProperty('priceCurrency', $currency);
            }
        }
        return parent::orderedItem($orderedItem);
    }
}
