<?php
/**
 * Drop database table for product expiry dates
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

$sql = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'product_expiry_date`';

Db::getInstance()->execute($sql);
