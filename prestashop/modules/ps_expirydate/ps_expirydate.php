<?php
/**
 * Product Expiry Date Module
 *
 * @author    Nutriweb
 * @copyright 2026 Nutriweb
 * @license   MIT
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DataColumn;

class Ps_ExpiryDate extends Module
{
    public function __construct()
    {
        $this->name = 'ps_expirydate';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Nutriweb';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '8.0.0',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Product Expiry Date');
        $this->description = $this->l('Manage expiry dates for products');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall this module?');
    }

    /**
     * Install module
     */
    public function install()
    {
        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install()
            && $this->registerHook('displayAdminProductsExtra')
            && $this->registerHook('actionProductUpdate')
            && $this->registerHook('actionAdminProductsListingFieldsModifier')
            && $this->registerHook('actionProductGridDefinitionModifier')
            && $this->registerHook('actionProductGridQueryBuilderModifier')
            && $this->registerHook('displayProductAdditionalInfo');
    }

    /**
     * Uninstall module
     */
    public function uninstall()
    {
        include(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall();
    }

    /**
     * Hook: Add expiry date field in product form (BackOffice)
     */
    public function hookDisplayAdminProductsExtra($params)
    {
        $id_product = (int)$params['id_product'];
        $expiry_date = $this->getExpiryDate($id_product);

        $this->context->smarty->assign([
            'expiry_date' => $expiry_date,
            'id_product' => $id_product,
        ]);

        return $this->display(__FILE__, 'views/templates/admin/product_expiry.tpl');
    }

    /**
     * Hook: Save expiry date when product is updated
     */
    public function hookActionProductUpdate($params)
    {
        $id_product = (int)$params['id_product'];
        $expiry_date = Tools::getValue('expiry_date');

        if ($expiry_date) {
            $this->saveExpiryDate($id_product, $expiry_date);
        } else {
            $this->deleteExpiryDate($id_product);
        }
    }

    /**
     * Hook: Add expiry date column in product list (BackOffice) - PrestaShop 8+
     */
    public function hookActionProductGridDefinitionModifier($params)
    {
        $definition = $params['definition'];
        
        $column = (new PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\DataColumn('expiry_date'))
            ->setName($this->l('Expiry Date'))
            ->setOptions([
                'field' => 'expiry_date',
            ]);
        
        $definition->getColumns()->addAfter('price', $column);
    }

    /**
     * Hook: Modify query to include expiry date in product list
     */
    public function hookActionProductGridQueryBuilderModifier($params)
    {
        $searchQueryBuilder = $params['search_query_builder'];
        
        $searchQueryBuilder->addSelect(
            'ped.expiry_date AS expiry_date'
        );
        
        $searchQueryBuilder->leftJoin(
            'p',
            _DB_PREFIX_ . 'product_expiry_date',
            'ped',
            'ped.id_product = p.id_product'
        );
    }

    /**
     * Hook: Display expiry date on product page (FrontOffice)
     */
    public function hookDisplayProductAdditionalInfo($params)
    {
        $id_product = (int)$params['product']['id_product'];
        $expiry_date = $this->getExpiryDate($id_product);

        if (!$expiry_date) {
            return '';
        }

        $formatted_date = date('d/m/Y', strtotime($expiry_date));

        $this->context->smarty->assign([
            'expiry_date' => $formatted_date,
        ]);

        return $this->display(__FILE__, 'views/templates/hook/product_expiry.tpl');
    }

    /**
     * Get expiry date for a product
     */
    private function getExpiryDate($id_product)
    {
        $sql = 'SELECT expiry_date FROM `' . _DB_PREFIX_ . 'product_expiry_date`
                WHERE id_product = ' . (int)$id_product;

        return Db::getInstance()->getValue($sql);
    }

    /**
     * Save expiry date for a product
     */
    private function saveExpiryDate($id_product, $expiry_date)
    {
        $exists = $this->getExpiryDate($id_product);

        if ($exists) {
            return Db::getInstance()->update(
                'product_expiry_date',
                ['expiry_date' => pSQL($expiry_date)],
                'id_product = ' . (int)$id_product
            );
        } else {
            return Db::getInstance()->insert(
                'product_expiry_date',
                [
                    'id_product' => (int)$id_product,
                    'expiry_date' => pSQL($expiry_date),
                ]
            );
        }
    }

    /**
     * Delete expiry date for a product
     */
    private function deleteExpiryDate($id_product)
    {
        return Db::getInstance()->delete(
            'product_expiry_date',
            'id_product = ' . (int)$id_product
        );
    }
}
