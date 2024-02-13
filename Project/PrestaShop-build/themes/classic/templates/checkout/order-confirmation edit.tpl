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

          
            
            
            <script>

              // document.getElementById("invoiceForm").addEventListener("submit", function(event) {
              // event.preventDefault(); // Prevent the default form submission
      
              // // Submit the form via AJAX
              // var xhr = new XMLHttpRequest();
              // xhr.open("POST", "http://localhost:8080/index.php?controller=pdf-invoice", true);
              // xhr.responseType = "blob"; // Response will be a binary blob
              // xhr.onload = function() {
              // if (xhr.status === 200) {
              //     // If successful, create a temporary link and trigger download
              //     var blob = new Blob([xhr.response], { type: "application/pdf" });
              //     var url = window.URL.createObjectURL(blob);
              //     var a = document.createElement("a");
              //     a.href = url;
              //     a.download = "invoice.pdf";
              //     document.body.appendChild(a);
              //     a.click();
              //     document.body.removeChild(a);
              //     window.URL.revokeObjectURL(url); // Clean up
              //   }};
              // xhr.send(new FormData(event.target));
              // });


                document.getElementById('uploadForm').addEventListener('submit', function(event) {
                    var fileInput = document.getElementById('fileToUpload');
                    if (fileInput.files.length === 0) {
                        event.preventDefault(); // ป้องกันการ submit ถ้าไม่มีไฟล์ถูกเลือก
                        alert('โปรดเลือกไฟล์ที่ต้องการอัปโหลด');
                    }else {
                      alert('โหลดไฟล์ สำเร็จ!!!');
                      alert('ขอบคุณสำหรับการบริจาค Thank You!!!');
                  }
                });
            
                document.getElementById('confirmButton').addEventListener('click', function(event) {
                    var fileInput = document.getElementById('fileToUpload');
                    if (fileInput.files.length === 0) {
                        event.preventDefault(); // ป้องกันการคลิกถ้าไม่มีไฟล์ถูกเลือก
                        alert('โปรดเลือกไฟล์ก่อนคลิกยืนยัน');
                    }
                });


                
            </script>
            
            {/block}

          </div>
        </div>
      </div>
    </section>
{/block}


