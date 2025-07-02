@include('partials.clients.headers')
<section class="container">
    <div class="card">
        <div class="card-header">
            <form action="/airconditioners/search" method="GET">
                @csrf
                <select class="form-control mt-2 d-none" name="brand_name" id="brand_name">
                    <option value="">Select Brand Name</option>
                    @foreach ($brands as $brand)
                        <option value="{{$brand}}"  <?=(strtoupper($brand) == strtoupper($brand_name) ? " selected" : "");?>>{{strtoupper($brand)}}</option>
                    @endforeach
                </select>

                <div id="div-brands">
                    <div class="d-flex flex-wrap justify-content-around overflow-auto mt-2" style="height:300px; border: 1px solid #e5e5e5;">
                        @foreach ($brands as $brand)
                        
                            <?php
                                if (isset($app_brand_logos[strtoupper($brand)]))
                                    $image = $app_brand_logos[strtoupper($brand)];
                                else
                                    $image = strtolower($brand).".jpg";
                            ?>
                            <div class="d-flex flex-column text-center m-3">
                                <img src="{{ asset( "images/brand_logos/$image") }}" alt="{{$brand}} logo" 
                                    class="img-brand img-fluid elevation-1"
                                    data-trigger='img-button' data-brand = "{{$brand}}"
                                />
                            </div>
                        
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        @if (count($airconditions) > 0)
        <div class="card-body">
            <div class="table-responsive p-0" id="div-brand-data">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th class="w-25">Read More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airconditions as $aircondition)
                            <tr>
                                <td>{{ $aircondition->sku }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="" class="btn btn-info btn-sm" data-object="{{$aircondition}}" data-trigger="modal">
                                        <i class="fa fa-search"></i>
                                        Explore
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $airconditions->links() }} 
        </div>
        @endif
    </div>
</section>
    <div class="modal fade" id="modelModal" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="p-title">Visit Site</p>
                    <div id="div-links"></div>
                </div>
            </div>
        </div>
    </div>

@include('partials.clients.footers')

{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> --}}
<script src="{{ asset('scripts/clients.js') }}"></script>