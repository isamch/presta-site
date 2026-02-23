{**
 * Custom Product Template - Nutri Hummingbird Child Theme
 * Extends parent Hummingbird theme
 * Modifications: Added delivery info block after product description short
 *}
{extends file='parent:catalog/product.tpl'}

{* Override product_description_short block to add delivery info *}
{block name='product_description_short'}
  <div class="product__description-short rich-text">{$product.description_short nofilter}</div>
  
  {* CUSTOM: Delivery Information Block *}
  <div class="product-delivery-info">
    <h3>{l s='Informations de livraison' d='Shop.Theme.Catalog'}</h3>
    <p>
      {l s='Livraison gratuite à partir de 500 DH. Délai de livraison : 2-3 jours ouvrables.' d='Shop.Theme.Catalog'}
    </p>
  </div>
{/block}
