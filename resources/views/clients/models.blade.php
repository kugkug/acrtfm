<?php header('X-Frame-Options: *'); ?>
@include('partials.clients.headers')
<section class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Model List - {{ $header }}
            </h3>
        </div>
        <div class="card-body">

            <div class=" table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airconditions as $aircondition)
                            <tr>
                                <td>{{ $aircondition->sku }}</td>
                                <td><a href="{{ $aircondition->url }}" target="_blank" class="text-info">View More</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer d-flex justify-content-center">
            {{ $airconditions->links() }} 
        </div>
    </div>
</section>

@include('partials.clients.footers')