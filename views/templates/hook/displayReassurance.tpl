<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  {l s="Ask about the product" mod='dsaskaboutproduct'}
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{l s="Ask about the product" mod='dsaskaboutproduct'}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-5">
                <img src="{$product.cover.large.url}" class="img-responsive" alt="{$product.name}">
            </div>
            <div class="col-lg-7">
                <form method="POST" id="dsaskaboutproduct_form">
                    <input type="hidden" name="dsaskaboutproduct">
                    <input type='hidden' name="dsaskaboutproduct_product_id" value="{$product.id}">
                    <div class="form-group">
                        <label>{l s="E-mail" mod='dsaskaboutproduct'}</label>
                        <input type="email" class="form-control" required name="dsaskaboutproduct_email">
                    </div>
                    <div class="form-group">
                        <label>{l s="Phone" mod='dsaskaboutproduct'}</label>
                        <input type="phone" class="form-control" name="dsaskaboutproduct_phone">
                    </div>
                    <div class="form-group">
                        <label>{l s="Message" mod='dsaskaboutproduct'}</label>
                        <textarea class="form-control" required name="dsaskaboutproduct_message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{l s="Send" mod='dsaskaboutproduct'}</button>
                    </div>
                    <div id="dsaskaboutproduct_response">
                        
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>