{extends file='page.tpl'}

{block name='page_content_container' prepend}
    <section id="content-hook_order_confirmation" class="card">
      <div class="card-block">
        <div class="row">
          <div class="col-md-12">

            {block name='order_confirmation_header'}
              <h3 class="h1 card-title">
                <i class="material-icons rtl-no-flip done">&#xE876;</i>{l s='Upload Slip...' d='Shop.Theme.Checkout'}
              </h3>
              
            {/block}

   

            {block name='hook_order_confirmation'}
              {* $HOOK_ORDER_CONFIRMATION nofilter *}
              
              <form action="index.php" method="post" enctype="multipart/form-data" id="uploadForm">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <br><br>
                <input class="btn btn-primary" id="confirmButton" type="submit" value="Upload File" name="submit">
                <br><br>
            </form>
            
            <br>

            
            
        
            
            {/block}

          </div>
        </div>
      </div>
    </section>
{/block}


