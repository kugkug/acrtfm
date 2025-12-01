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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @foreach($technicians as $technician)
                    @php
                        $name = $technician['name'] ?? 'N/A';
                        $email = $technician['email'] ?? 'N/A';
                        $isCompanyConfirmed = strtolower($technician['is_company_confirmed'] ?? 'no') === 'yes';
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

                            <dd>
                                <i class="fa fa-check-circle mr-2"></i>
                                Status:
                                @if($isCompanyConfirmed)
                                    <span class="badge badge-success">Company Confirmed</span>
                                @else
                                    <span class="badge badge-secondary">Pending Confirmation</span>
                                @endif
                            </dd>

                            @if(isset($technician['created_at']))
                                <dd>
                                    <i class="fa fa-calendar mr-2"></i> 
                                    Joined: {{ formatDateWithTimezone($technician['created_at']) }}
                                </dd>
                            @endif
                                
                            {{-- @if(auth()->check() && auth()->user()->user_type === config('acrtfm.user_types.company'))
                                <dd>
                                    <form method="POST" action="{{ route('technicians.company-confirmation', $technician['id']) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $isCompanyConfirmed ? 'no' : 'yes' }}">
                                        <button type="submit" class="btn btn-sm {{ $isCompanyConfirmed ? 'btn-warning' : 'btn-success' }}">
                                            <i class="fa {{ $isCompanyConfirmed ? 'fa-ban' : 'fa-check' }}"></i>
                                            {{ $isCompanyConfirmed ? 'Revoke Access' : 'Grant Access' }}
                                        </button>
                                    </form>
                                </dd>
                            @endif --}}
                        </dl>

                        <div class="card-footer p-0">
                            @if(auth()->check() && auth()->user()->user_type === config('acrtfm.user_types.company'))
                                <form method="POST" action="{{ route('technicians.company-confirmation', $technician['id']) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $isCompanyConfirmed ? 'no' : 'yes' }}">
                                    <button type="submit" class="mt-2 btn btn-sm {{ $isCompanyConfirmed ? 'btn-warning' : 'btn-success' }}">
                                        <i class="fa {{ $isCompanyConfirmed ? 'fa-ban' : 'fa-check' }}"></i>
                                        {{ $isCompanyConfirmed ? 'Revoke Access' : 'Grant Access' }}
                                    </button>
                                </form>
                            @endif
                        </div>
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

