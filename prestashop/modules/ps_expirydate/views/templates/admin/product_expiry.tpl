<div class="form-group">
    <label class="control-label col-lg-3">
        <span class="label-tooltip" data-toggle="tooltip" title="{l s='Set the expiry date for this product' mod='ps_expirydate'}">
            {l s='Expiry Date' mod='ps_expirydate'}
        </span>
    </label>
    <div class="col-lg-9">
        <input type="date" 
               name="expiry_date" 
               id="expiry_date" 
               class="form-control" 
               value="{$expiry_date|escape:'html':'UTF-8'}" />
        <p class="help-block">
            {l s='Leave empty if the product does not have an expiry date' mod='ps_expirydate'}
        </p>
    </div>
</div>
