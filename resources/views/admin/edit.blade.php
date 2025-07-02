@include('partials.admin.headers')
<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-wind"></i>
                    Information
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-xl">
                        <i class="fas fa-file-pdf"></i>
                        Upload
                    </button>    
                </div>
            </div>

            <form action="/execute/ac-update/{{ $aircondition[0]->id }}" method="POST">
                @method('PUT')
                @csrf
                
                <div class="card-body">
                    @if(session()->has('message'))
                        <h4 class="text-success">{{session('message')}}</h4>
                    @endif
                    <div class="form-group">
                        <label for="name">Model</label>
                        <input type="text" class="form-control " placeholder="Model" value="{{ $aircondition[0]->sku }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Brand</label>
                        <input type="text" class="form-control " placeholder="Brand" value="{{ $aircondition[0]->brand }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Brand Website</label>
                        <input type="text" class="form-control " placeholder="Website URL" value="{{ $aircondition[0]->url }}">
                    </div>

                    @if(sizeof($aircondition[0]->manuals) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($aircondition[0]->manuals as $manual)
                                    <?php
                                        $sPath = asset('manuals/' . $manual->filename);
                                    ?>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <h4>{{ ucwords(strtolower($manual->label)) }}</h4>
                                            <span>
                                                <button class="btn btn-danger" data-id={{$manual->id}} data-trigger='delete-pdf'>
                                                    <i class='fa fa-trash'></i>
                                                    Delete
                                                </button>
                                            </span>
                                        </div>
                                        <iframe src="{{ $sPath }}" frameborder="0" height="450" style="width: 100%;"></iframe>
                                        <hr />
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    @endif

                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-hard-drive"></i>
                            Update
                        </button>

                        <a href="/admin/dashboard" class="btn btn-danger">
                            <i class="fa-solid fa-rotate-left"></i>
                            Back To List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-xl" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload PDF File</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body modal-upload-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" id="txdtAcId" value="{{ $aircondition[0]->id }}">
                    <div class="file-drop-area text-center">
                        <div>
                            <span class="choose-file-button">Choose files</span>
                            <span class="file-message">or drag and drop files here</span>
                            <input class="file-input" type="file" id="txtFiles" multiple>
                            <br />                        
                        </div>
                    </div>

                    <div class="row div-main-uploads d-none">
                        <div class="col-md-12" id="div-uploads">
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" id="btn-review">Upload Files</button>
            <button type="button" class="btn btn-danger" id="btn-reset" >Clear</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@include('partials.admin.footers')
<script src="{{asset('scripts/modules/admin/ac-edit.js')}}"></script>