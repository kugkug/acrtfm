@include('partials.admin.headers')
    {{-- <div class="d-flex justify-content-center flex-nowrap" style="height: 80vh; border: 1px solid red;"> --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Synchronize Airconditioner's Data</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="callout callout-danger d-none" id="div-callout">
                            <p>Synchronization in progress</p>
                        </div>

                        <button id="div-button" class="btn btn-danger btn-block " data-trigger="synch-ac">Synch Airconditioner's Data</button>

                        <div class="mt-5 callout callout-success d-none" id="div-done">
                            <p>Synchronization successful.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 d-none" id="div-progress">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">Synch in progress</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-student"></i> Synchronize Education's Data</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="callout callout-danger d-none" id="div-callout-educ">
                            <p>Synchronization in progress</p>
                        </div>

                        <button id="div-button-educ" class="btn btn-danger btn-block " data-trigger="synch-educ">Synch Education's Data</button>

                        <div class="mt-5 callout callout-success d-none" id="div-done-educ">
                            <p>Synchronization successful.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 d-none" id="div-progress-educ">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">Synch in progress</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-users"></i> Synchronize User's Data</h3>
            </div>
            <div class="card-body">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="callout callout-danger d-none" id="div-callout-user">
                            <p>Synchronization in progress</p>
                        </div>

                        <button id="div-button-user" class="btn btn-danger btn-block " data-trigger="synch-user">Synch User's Data</button>

                        <div class="mt-5 callout callout-success d-none" id="div-done-user">
                            <p>Synchronization successful.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 d-none" id="div-progress-user">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">Synch in progress</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
    <script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('scripts/modules/synch.js') }}"></script>
@include('partials.admin.footers')
