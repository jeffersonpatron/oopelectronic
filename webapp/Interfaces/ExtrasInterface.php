<?php

namespace WebApp\Interfaces;

use WebApp\Entity\Item;

//Declare the interface 'ExtrasInterface'
interface ExtrasInterface
{
    //Function to limit the number of extras an electronic item can have
    public function maxExtras() : bool;
}