<!-- Central Modal Small -->
<div class="modal fade" id="processingStatMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title w-100" id="myModalLabel">Processing your request. Please wait ..</h6>
      </div>
      <div class="modal-body">
          <div class="col-lg-12 d-flex justify-content-center">
            <div class="spinner-border" role="status" id="loader" style="display:none;">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        <div class="row">
          <div class="col-lg-12">
          <p class="mt-3 text-black text-center" id="status">..</p>
          <p class="mt-3 text-black text-center" id="count">..</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" id="processingProgress" style="width: 0;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->