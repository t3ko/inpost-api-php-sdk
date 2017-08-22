<?php
/**
 * Copyright (c) 2017. Tomasz Konarski.
 */

namespace T3ko\Inpost\Objects;


class PaymentType
{

    const NONE = 0;
    const CASH = 1;
    const CARD = 2;
    const CASH_AND_CARD = self::CASH && self::CARD;

}