{**
 * Custom Header Template - Nutri Hummingbird Child Theme
 * Extends parent Hummingbird theme
 * Modifications: Custom header top styling
 *}
{extends file='parent:_partials/header.tpl'}

{* Override header_nav block to add custom class *}
{block name='header_nav'}
  <nav class="{$headerTopName} nutri-header-top">
    <div class="container-md">
      <div class="{$headerTopName}-desktop d-none d-md-flex row">
        <div class="{$headerTopName}__left col-md-5">
          {hook h='displayNav1'}
        </div>

        <div class="{$headerTopName}__right col-md-7">
          {hook h='displayNav2'}
        </div>
      </div>
    </div>
  </nav>
{/block}
