<?php
declare(strict_types=1);

namespace De\Swebhosting\Createorder\Controller\Admin;

use Exception;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Field;
use OxidEsales\Eshop\Core\Registry;

class UserMain extends UserMain_parent
{
    /**
     * @var string
     */
    protected $oderCreateError;

    /**
     * Creates a new order for the selected user.
     */
    public function createorder()
    {
        $soxId = $this->getEditObjectId();

        if (!$soxId || $soxId == '-1') {
            $this->oderCreateError = 'CREATE_ORDER_ERROR_NO_USER';
        }

        if (!$this->_allowAdminEdit($soxId)) {
            return;
        }

        $oUser = oxNew(User::class);
        if (!$oUser->load($soxId)) {
            $this->oderCreateError = 'CREATE_ORDER_ERROR_INVALID_USER';
        }

        try {
            $oBasket = oxNew(Basket::class);

            $oPayment = oxNew(Payment::class);
            if ($oPayment->load('oxempty')) {
                $oBasket->setPayment($oPayment->getId());
            }

            $oOrder = oxNew(Order::class);
            $oOrder->oxorder__oxorderdate = null;

            $myConfig = Registry::getConfig();
            $oOrder->oxorder__oxfolder = new Field(
                key($myConfig->getShopConfVar('aOrderfolder', $myConfig->getShopId())),
                Field::T_RAW
            );

            $this->finalizeOrder($oOrder, $oBasket, $oUser);
        } catch (Exception $oExcp) {
            $this->oderCreateError = $oExcp->getMessage();
        }

        $this->_aViewData['sSaveError'] = $this->oderCreateError;
    }

    private function finalizeOrder(Order $oOrder, Basket $oBasket, User $oUser): void
    {
        $iSuccess = $oOrder->finalizeOrder($oBasket, $oUser, true);

        if ($iSuccess != Order::ORDER_STATE_OK) {
            $this->oderCreateError = 'CREATE_ORDER_ERROR_' . $iSuccess;
            return;
        }

        $this->oderCreateError = 'CREATE_ORDER_SUCCESS';
    }
}
