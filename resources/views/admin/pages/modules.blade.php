@include('partials.admin.headers')
    @foreach ($module_list as $identifier =>  $module)
        <?php
        
            $header_title = strtoupper( str_replace("_", " ",$module['title']));
            $module_label = ucwords( strtolower( $module['label'] ) );
            $module_icon = $module['icon'];
            $module_id = $module['id'];
        ?>
        <div class="row">
            <div class="col-md-12">
                <form>
                    <input type="hidden" class="form-control" placeholder="Header Title" value="{{ $identifier }}" data-key='identifier'>
                    <div class="card card-outline card-success collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {!!$module_icon!!} 
                                {{$header_title}}
                            </h3>
            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="">Header Label</label>
                                    <input type="text" class="form-control" placeholder="Header Title" value="{{ $header_title }}" data-key='title'>
                                </div>
                                <div class="form-group">
                                    <label for="">Tile Label</label>
                                    <input type="text" class="form-control" placeholder="Header Title" value="{{ $module_label }}" data-key='label'>
                                </div>
                            </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-block" data-trigger="update-module" data-id="{{$module_id}}">Submit</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>    
    @endforeach
    
@include('partials.admin.footers')

<script src="{{ asset('scripts/modules/admin/modules.js') }}"></script>