<?php

class ServiceController extends Controller {
    
    private $integPassword = "sami-khalid-adil-bijith"; //Integration Password to add security

    public function actions() {
        return array(
            'soap' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }


    /**
     * @param int customer Id
     * @param string customer Name
     * @param string customer Phone Number
     * @param string customer Email
     * @param string customer Civil Id
     * @param string Integration Password
     * @return string confirmation message "created"
     * @soap
     */
    public function createCustomer($customerId, $customerName, $customerPhone, $customerEmail, $customerCivilId, $integrationPassword = "sami-khalid-adil-bijith") {
        $customerId = (int) $customerId;
        
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");

        $customer = Customer::model()->findByPk($customerId);
        if (!$customer) {
            $customer = new Customer();
            $customer->customer_id = $customerId;
            $customer->customer_name = $customerName;
            $customer->customer_phone = $customerPhone;
            $customer->customer_email = $customerEmail;
            $customer->customer_civil_id = $customerCivilId;

            if ($customer->save())
                return "created";
            else
                return print_r($customer->errors, true);
        }
        else
            return "already exists";
    }
    
    /**
     * @param int customer Id
     * @param string customer Name
     * @param string customer Phone Number
     * @param string customer Email
     * @param string customer Civil Id
     * @param string Integration Password
     * @return string confirmation message "updated"
     * @soap
     */
    public function updateCustomer($customerId, $customerName, $customerPhone, $customerEmail, $customerCivilId, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $customerId = (int) $customerId;

        $customer = Customer::model()->findByPk($customerId);
        if ($customer) {
            $customer->customer_id = $customerId;
            $customer->customer_name = $customerName;
            $customer->customer_phone = $customerPhone;
            $customer->customer_email = $customerEmail;
            $customer->customer_civil_id = $customerCivilId;

            if ($customer->save())
                return "updated";
            else
                return print_r($customer->errors, true);
        }
        else
            return "Customer does not exist";
    }
    
    /**
     * @param int customer Id
     * @param string Integration Password
     * @return string confirmation message "deleted"
     * @soap
     */
    public function deleteCustomer($customerId, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $customerId = (int) $customerId;
        Customer::model()->deleteByPk($customerId);
        return "deleted";
    }
    
    /**
     * @param int The Item/Box ID
     * @param int customer ID
     * @param string item name
     * @param string items ingredients
     * @param string Integration Password
     * @return string confirmation message "created"
     * @soap
     */
    public function createItem($itemId, $customerId, $itemName, $itemIngredients, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $itemId = (int) $itemId;

        $item = Item::model()->findByPk($itemId);
        if (!$item) {
            $item = new Item();
            $item->item_id = $itemId;
            $item->customer_id = (int) $customerId;
            $item->item_name = $itemName;
            $item->item_ingredients = $itemIngredients;

            if ($item->save())
                return "created";
            else
                return print_r($item->errors, true);
        }
        else
            return "already exists";
    }

    /**
     * @param int The Item/Box ID
     * @param int customer ID
     * @param string item name
     * @param string items ingredients
     * @param string Integration Password
     * @return string confirmation message "updated"
     * @soap
     */
    public function updateItem($itemId, $customerId, $itemName, $itemIngredients, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $itemId = (int) $itemId;

        $item = Item::model()->findByPk($itemId);
        if ($item) {
            //$item->scenario = 'changePw';
            $item->item_id = $itemId;
            $item->customer_id = (int) $customerId;
            $item->item_name = $itemName;
            $item->item_ingredients = $itemIngredients;

            if ($item->save())
                return "updated";
            else
                return print_r($item->errors, true);
        }
        else
            return "Item does not exist";
    }

    /**
     * @param int The Item/Box ID
     * @param string Integration Password
     * @return string confirmation message "deleted"
     * @soap
     */
    public function deleteItem($itemId, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $itemId = (int) $itemId;
        Item::model()->deleteByPk($itemId);
        return "deleted";
    }

    /**
     * @param int The sale id
     * @param int The Item/Box Id
     * @param int quantity of item sold
     * @param string Integration Password
     * @return string confirmation message "created"
     * @soap
     */
    public function createSale($saleId, $itemId, $saleQuantity, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $saleId = (int) $saleId;
        $sale = Sale::model()->findByPk($saleId);
        if (!$sale) {
            $sale = new Sale();
            $sale->sale_id = $saleId;
            $sale->item_id = (int) $itemId;
            //error_log("ITEM ID: $itemId");
            $sale->sale_quantity = (int) $saleQuantity;
            $sale->sale_datetime = new CDbExpression("NOW()");
            if ($sale->save())
                return "created";
            else
                return print_r($sale->errors, true);
        }
        else
            return "already exists";
    }
    
    /**
     * @param int The Item/Box ID
     * @param string Integration Password
     * @return string confirmation message "deleted"
     * @soap
     */
    public function deleteSale($saleId, $integrationPassword = "sami-khalid-adil-bijith") {
        if($integrationPassword != $this->integPassword) exit("ERROR - KM192832");
        
        $saleId = (int) $saleId;
        Sale::model()->deleteByPk($saleId);
        return "deleted";
    }

}