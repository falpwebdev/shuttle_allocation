 <div class="modal fade" id="filedDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-xl" role="document">
   <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Filing Details (<span id="section"></span>)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-12 d-flex justify-content-end">
          <button class="btn btn-sm btn-danger" id="btnExportDSummary"><i class="fas fa-download"></i> Export Department Summary</button>
        </div>
      </div>
      <div class="row" id="deptSummary">
        <div class="col lg-12">
          <table class="table table-sm table-bordered text-center" id="detailsCFiledTbl">
          </table>
        </div>
        <div class="col-lg-12">
          <table class="table table-sm table-bordered text-center" id="detailsFiledTbl">
            <thead>
              <tr>
                <th>Section</th>
                <th>Line No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Route</th>
                <th>OutGoing</th>
                <th>Time Filed</th>
                <th>Filed By</th>
              </tr>
            </thead>
            <tbody id="tblfiledMP">
            </tbody>
          </table>
        </div>
      </div>
    </div>
   </div>
  </div>
 </div>
