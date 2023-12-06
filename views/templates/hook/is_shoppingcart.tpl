{**
 * 2007-2020 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div class="header-top__block header-top__block--cart col flex-grow-0">
  <div
    class="js-cart-preview cart-preview {if $previewType === 'dropdown'}dropdown{/if}"
  >
    {include 'module:is_shoppingcart/views/templates/front/header-btn.tpl'}

    {if $previewType === 'dropdown'}
      {include 'module:is_shoppingcart/views/templates/front/preview-dropdown.tpl'}
    {elseif $previewType === 'offcanvas'}
      {include 'module:is_shoppingcart/views/templates/front/preview-offcanvas.tpl'}
    {/if}
  </div>
</div>
