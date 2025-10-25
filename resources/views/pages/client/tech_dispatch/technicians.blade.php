@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <x-card> 
                <x-input :attrib="[
                    'name' => 'search',
                    'placeholder' => 'Search technicians...',
                    'dataKey' => 'search',
                    'class' => 'form-control form-control-sm override-input',
                ]" />
            </x-card>

            @if(isset($technicians) && count($technicians) > 0)
                @foreach($technicians as $technician)
                    @php
                        $name = $technician['name'] ?? 'N/A';
                        $email = $technician['email'] ?? 'N/A';
                    @endphp

                    <x-card
                        :title="$name"
                        :subtitle="$email"
                        :hr="true"
                    >
                        <dl>
                            @if(isset($technician['email']))
                                <dd><i class="fa fa-envelope mr-2"></i> {{ $technician['email'] }}</dd>
                            @endif

                            @if(isset($technician['phone']))
                                <dd><i class="fa fa-phone mr-2"></i> {{ $technician['phone'] }}</dd>
                            @endif
                        
                            @if(isset($technician['company_name']))
                                <dd><i class="fa fa-building mr-2"></i> {{ $technician['company_name'] }}</dd>
                            @endif

                            @if(isset($technician['user_type']))
                                <dd>
                                    <i class="fa fa-user mr-2"></i> 
                                    <span class="badge badge-info">{{ ucfirst($technician['user_type']) }}</span>
                                </dd>
                            @endif

                            @if(isset($technician['created_at']))
                                <dd>
                                    <i class="fa fa-calendar mr-2"></i> 
                                    Joined: {{ \Carbon\Carbon::parse($technician['created_at'])->format('M d, Y') }}
                                </dd>
                            @endif
                        </dl>
                    </x-card>
                @endforeach
            @else
                <x-card>
                    <div class="text-center py-5">
                        <i class="fa fa-users fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No technicians found</p>
                    </div>
                </x-card>
            @endif
        </div>
    </div>
</section>

@include('partials.auth.footer')

