<div class="modal fade" id="uploadMPMod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-full-height modal-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Uploading Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="statSummary">
          <div class="col lg-12">
          <table class="table table-sm table-bordered text-center" id="uploadStatTbl">
            <thead>
              <tr>
                <th>ID Number</th>
                <th>Error</th>
              </tr>
            </thead>
            <tbody id="tblUploadStat">
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" id="btnCloseMod" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" id="btnExportError">Download Error Report</button>
      </div>
    </div>
  </div>
</div>
