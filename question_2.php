<?php

/**
 * This file belongs to Question 2
 * @author Anil Konsal <anil.konsal@gmail.com>
 */

namespace SoftwareEngineerTest;

/**
 * Class Customer
 */
abstract class Customer {

    protected $id;
    protected $balance = 0;

    public function __construct($id) {
        $this->id = $id;
    }

    public function get_balance() {
        return $this->balance;
    }

    public function generate_username($prefix) {
        if (empty($prefix)) {
            throw new \InvalidArgumentException('Please provide a prefix!');
        }
        
        // Generate a random string of 30 alphanumeric characters
        $suffix = substr(md5(sha1(microtime())), 0, 30);
        return $prefix . $suffix;
    }

}

class Bronze_Customer extends Customer {

    protected $_prefix = 'B';

    /**
     * Functiion to perform deposit for customer
     * @param float $amount
     * @return float
     */
    public function deposit($amount) {
        return $this->balance = $amount;
    }
    
    /**
     * Function to generate the username
     * @return strung
     */
    public function generate_username() {
        return parent::generate_username($this->_prefix);
    }
}

class Silver_Customer extends Customer {
    
    protected $_prefix = 'S';
    
    /**
     * Functiion to perform deposit for customer
     * @param float $amount
     * @return float
     */
    public function deposit($amount) {
        $balance += $amount * 0.05;
        return $this->balance = $balance;
    }
    
    /**
     * Function to generate the username
     * @return strung
     */
    public function generate_username() {
        return parent::generate_username($this->_prefix);
    }
}

class Gold_Customer extends Customer {
    
    protected $_prefix = 'G';

    /**
     * Functiion to perform deposit for customer
     * @param float $amount
     * @return float
     */
    public function deposit($amount) {
        $balance += $amount * 0.1;
        return $this->balance = $balance;
    }
    
     /**
     * Function to generate the username
     * @return strung
     */
    public function generate_username() {
        return parent::generate_username($this->_prefix);
    }
}


/**
 * Customer Factory class to return the object of customer class based on the 
 * type of the customer
 */
class CustomerFactory {

    /**
     * Function to instantiate an object of relavant class based on the customer_id
     * provided
     * @param string $customer_id
     * @return customer
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public static function get_instance($customer_id) {
        if (empty($customer_id)) {
            throw new Exception('Customer ID is required and not provided!');
        }

        $prefix = substr($customer_id, 0, 1);

        switch ($prefix) {
            case 'B':
                $customer = new Bronze_Customer();
                break;

            case 'S':
                $customer = new Silver_Customer;
                break;

            case 'G':
                $customer = new Gold_Customer();
                break;

            default:
                throw new InvalidArgumentException('Argument not supported!');
                break;
        }

        return $customer;
    }

}
