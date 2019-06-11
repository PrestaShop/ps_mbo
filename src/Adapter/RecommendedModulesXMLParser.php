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

namespace PrestaShop\Module\Mbo\Adapter;

/**
 * Class RecommendedModulesXMLParser is responsible for providing recommended modules.
 */
class RecommendedModulesXMLParser
{
    private $content;

    /**
     * Constructor.
     *
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];

        if (empty($this->content)) {
            return $data;
        }

        $simpleXMLElement = @simplexml_load_string($this->content);

        if (false === $simpleXMLElement
            || !isset($simpleXMLElement->tab)
        ) {
            return $data;
        }

        foreach ($simpleXMLElement->tab as $tab) {
            $tabClassName = null;
            $tabDisplayMode = null;
            $tabRecommendedModules = [];
            foreach ($tab->attributes() as $key => $value) {
                if ('class_name' === $key) {
                    $tabClassName = (string) $value;
                }
                if ('display_type' === $key) {
                    $tabDisplayMode = (string) $value;
                }
            }
            foreach ($tab->children() as $module) {
                if (isset($module['position'], $module['name'])) {
                    $tabRecommendedModules[(int) $module['position']] = (string) $module['name'];
                }
            }
            if (!empty($tabClassName)) {
                $data[$tabClassName] = [
                    'displayMode' => $tabDisplayMode,
                    'recommendedModules' => $tabRecommendedModules,
                ];
            }
        }

        return $data;
    }
}