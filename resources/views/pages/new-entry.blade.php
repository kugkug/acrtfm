@include('partials.clients.headers')
<div class="row">
    <div class="col-md-6">
      
      <!-- /.card -->
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-outline card-danger">
              <h3 class="card-title">Information</h3>              
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Manufacturer's Name</label>
                <input type="text" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Model No.</label>
                <input type="text" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputDescription">Project Description</label>
                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Installation Manual</label>
                <input type="text" id="inputClientCompany" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Service Manual</label>
                <input type="text" id="inputClientCompany" class="form-control">
              </div>

              <button class="btn btn-outline-primary btn-block">Add</button>
            </div>
            <!-- /.card-body -->
          </div>
      <!-- /.card -->
    </div>
  </div>
@include('partials.clients.footers')