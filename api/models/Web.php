<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;

class Web extends Model
{

    public function initialize()
    {
        //$this->setConnectionService('ohome');
    }
    /**
     * 函数名：getSource
     * 函数作用：返回表名
     */
    public function getSource()
    {
        return "mcc_yl_web";
    }

    public function validation()
    {

        // Type must be: droid, mechanical or virtual
        $this->validate(
            new InclusionIn(
                array(
                    "field"  => "type",
                    "domain" => array(
                        "droid",
                        "mechanical",
                        "virtual"
                    )
                )
            )
        );

        // Robot name must be unique
        $this->validate(
            new Uniqueness(
                array(
                    "field"   => "name",
                    "message" => "The robot name must be unique"
                )
            )
        );

        // Year cannot be less than zero
        if ($this->year < 0) {
            $this->appendMessage(new Message("The year cannot be less than zero"));
        }

        // Check if any messages have been produced
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
