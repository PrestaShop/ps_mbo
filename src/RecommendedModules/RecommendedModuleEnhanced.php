<?php
/**
 * 2007-2019 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0  Academic Free License (AFL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\Module\Mbo\RecommendedModules;

class RecommendedModuleEnhanced extends RecommendedModule implements RecommendedModuleEnhancedInterface
{
    /**
     * @var bool
     */
    private $isInstalled;

    /**
     * @var array
     */
    private $moduleData;

    /**
     * Constructor.
     *
     * @param string $moduleName
     * @param int $position
     * @param bool $isInstalled
     * @param array $moduleData
     */
    public function __construct($moduleName, $position, $isInstalled, array $moduleData)
    {
        parent::__construct($moduleName, $position);
        $this->isInstalled = $isInstalled;
        $this->moduleData = $moduleData;
    }

    /**
     * {@inheritdoc}
     */
    public function isInstalled()
    {
        return $this->isInstalled;
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleData()
    {
        return $this->moduleData;
    }
}