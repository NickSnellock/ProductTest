<?php


namespace App\Entities;

use MyCLabs\Enum\Enum;

class ProductTypeEnum extends Enum
    /**
     * @method static self INCOME()
     * @method static self MOTOR()
     * @method static self TRAVEL()
     * @method static self HOME()
     */
{
    private const INCOME = 'income';
    private const MOTOR = 'motor';
    private const TRAVEL = 'travel';
    private const HOME = 'home';
}