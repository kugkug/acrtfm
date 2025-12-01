@include('partials.auth.header')

@php
    $user = auth()->user();
    $userType = $user->user_type ?? '';
    $userTypeLabel = config('acrtfm.user_types.' . strtolower($userType), $userType);
@endphp

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <!-- Profile Header Card -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="row align-items-center">
                                {{-- <div class="col-md-2 text-center">
                                    <div class="profile-avatar mb-3">
                                        <img src="{{ asset('assets/system/images/acrtfm_logo.png') }}" 
                                             alt="Profile" 
                                             class="rounded-circle" 
                                             style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #e0e0e0;">
                                    </div>
                                </div> --}}
                                <div class="col-md-10">
                                    <h2 class="mb-2">{{ $user->name ?? 'N/A' }}</h2>
                                    <p class="text-muted mb-2">
                                        <i class="fa fa-envelope mr-2"></i>{{ $user->email ?? 'N/A' }}
                                    </p>
                                    {{-- @if($user->email_verified_at)
                                        <span class="badge badge-success">
                                            <i class="fa fa-check-circle mr-1"></i>Email Verified
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fa fa-exclamation-circle mr-1"></i>Email Not Verified
                                        </span>
                                    @endif --}}
                                    @if($userType)
                                        <span class="badge badge-info">
                                            <i class="fa fa-user-tag mr-1"></i>{{ $userTypeLabel }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-2 text-right">
                                    <button 
                                        type="button" 
                                        class="btn btn-primary btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#editProfileModal"
                                    >
                                        <i class="fa fa-edit mr-1"></i>Edit Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fa fa-user mr-2"></i>Personal Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">Name:</dt>
                                <dd class="col-sm-8">{{ $user->name ?? 'N/A' }}</dd>

                                @if($user->first_name || $user->last_name)
                                    <dt class="col-sm-4">First Name:</dt>
                                    <dd class="col-sm-8">{{ $user->first_name ?? 'N/A' }}</dd>

                                    <dt class="col-sm-4">Last Name:</dt>
                                    <dd class="col-sm-8">{{ $user->last_name ?? 'N/A' }}</dd>
                                @endif

                                <dt class="col-sm-4">Email:</dt>
                                <dd class="col-sm-8">
                                    {{ $user->email ?? 'N/A' }}
                                    @if($user->email_verified_at)
                                        <span class="badge badge-success badge-sm ml-2">Verified</span>
                                    @endif
                                </dd>

                                @if($user->phone || $user->contact)
                                    <dt class="col-sm-4">Phone:</dt>
                                    <dd class="col-sm-8">{{ $user->phone ?? $user->contact ?? 'N/A' }}</dd>
                                @endif

                                @if($user->contact_person)
                                    <dt class="col-sm-4">Contact Person:</dt>
                                    <dd class="col-sm-8">{{ $user->contact_person }}</dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Company/Organization Information -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fa fa-building mr-2"></i>Company/Organization Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                @if($user->company)
                                    <dt class="col-sm-4">Company:</dt>
                                    <dd class="col-sm-8">{{ $user->company }}</dd>
                                @endif

                                @if($user->company_code)
                                    <dt class="col-sm-4">Company Code:</dt>
                                    <dd class="col-sm-8">
                                        <code>{{ $user->company_code }}</code>
                                    </dd>
                                @endif

                                @if($user->address)
                                    <dt class="col-sm-4">Address:</dt>
                                    <dd class="col-sm-8">{{ $user->address }}</dd>
                                @endif

                                @if($user->is_company_confirmed !== null)
                                    <dt class="col-sm-4">Company Status:</dt>
                                    <dd class="col-sm-8">
                                        @if($user->isCompanyConfirmed())
                                            <span class="badge badge-success">
                                                <i class="fa fa-check-circle mr-1"></i>Confirmed
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fa fa-clock mr-1"></i>Pending Confirmation
                                            </span>
                                        @endif
                                    </dd>
                                @endif

                                @if($user->user_type)
                                    <dt class="col-sm-4">User Type:</dt>
                                    <dd class="col-sm-8">
                                        <span class="badge badge-info">{{ $userTypeLabel }}</span>
                                    </dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fa fa-info-circle mr-2"></i>Account Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                <dt class="col-sm-4">User ID:</dt>
                                <dd class="col-sm-8"><code>#{{ $user->id }}</code></dd>

                                <dt class="col-sm-4">Account Created:</dt>
                                <dd class="col-sm-8">
                                    {{ $user->created_at ? formatDateWithTimezone($user->created_at, 'F d, Y') : 'N/A' }}
                                    <small class="text-muted d-block">
                                        {{ $user->created_at ? formatDateWithTimezone($user->created_at, 'h:i A') : '' }}
                                    </small>
                                </dd>

                                <dt class="col-sm-4">Last Updated:</dt>
                                <dd class="col-sm-8">
                                    {{ $user->updated_at ? formatDateWithTimezone($user->updated_at, 'F d, Y') : 'N/A' }}
                                    <small class="text-muted d-block">
                                        {{ $user->updated_at ? formatDateWithTimezone($user->updated_at, 'h:i A') : '' }}
                                    </small>
                                </dd>

                                @if($user->email_verified_at)
                                    <dt class="col-sm-4">Email Verified:</dt>
                                    <dd class="col-sm-8">
                                        {{ formatDateWithTimezone($user->email_verified_at, 'F d, Y') }}
                                        <small class="text-muted d-block">
                                            {{ formatDateWithTimezone($user->email_verified_at, 'h:i A') }}
                                        </small>
                                    </dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fa fa-cog mr-2"></i>Additional Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
                                @if($user->remember_token)
                                    <dt class="col-sm-4">Remember Token:</dt>
                                    <dd class="col-sm-8">
                                        <small class="text-muted">Active</small>
                                    </dd>
                                @endif

                                <dt class="col-sm-4">Account Status:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge badge-success">
                                        <i class="fa fa-check-circle mr-1"></i>Active
                                    </span>
                                </dd>

                                @if($user->user_type == config('acrtfm.user_types.technician'))
                                    <dt class="col-sm-4">Technician Status:</dt>
                                    <dd class="col-sm-8">
                                        @if($user->isCompanyConfirmed())
                                            <span class="badge badge-success">
                                                <i class="fa fa-check-circle mr-1"></i>Company Confirmed
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fa fa-exclamation-circle mr-1"></i>Awaiting Company Confirmation
                                            </span>
                                        @endif
                                    </dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Edit Profile Modal -->
@php
    $footer = [
        [
            'type' => 'button',
            'text' => 'Update Profile',
            'icon' => 'fa fa-save',
            'attrib' => [
                'class' => 'btn btn-success btn-flat',
                'title' => 'Update Profile',
                'data-trigger' => 'update-profile',
            ],
        ],
        [
            'type' => 'button',
            'text' => 'Cancel',
            'icon' => 'fa fa-times',
            'attrib' => [
                'class' => 'btn btn-danger btn-flat',
                'title' => 'Cancel',
                'data-dismiss' => 'modal',
            ],
        ]
    ];

@endphp

<x-modal 
    
    title="Edit Profile"
    :footer="$footer"
    :attrib="
    [
        'class' => 'modal-dialog modal-dialog-centered modal-lg', 
        'id' => 'editProfileModal'
    ]"
>    
        @if($userType == config('acrtfm.user_types.company'))
            {{-- Company User Fields --}}
            <div class="row">
                <div class="col-md-6">
                    <x-input 
                        :attrib="[
                            'name' => 'company_code',
                            'label' => 'Company Code',
                            'data-key' => 'CompanyCode',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->company_code ?? '',
                            'readonly' => true,
                        ]"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-input 
                        :attrib="[
                            'name' => 'company',
                            'label' => 'Company Name',
                            'data-key' => 'Company',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->company ?? $user->name ?? '',
                        ]"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-input 
                        :attrib="[
                            'name' => 'email',
                            'label' => 'Email',
                            'type' => 'email',
                            'data-key' => 'Email',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->email ?? '-',
                        ]"
                    />
                </div>
                <div class="col-md-6">
                    <x-input 
                        :attrib="[
                            'name' => 'contact',
                            'label' => 'Contact',
                            'data-key' => 'Contact',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->contact ?? '',
                        ]"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-input 
                        :attrib="[
                            'name' => 'contact_person',
                            'label' => 'Contact Person',
                            'data-key' => 'ContactPerson',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->contact_person ?? '',
                        ]"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-textarea 
                        :attrib="[
                            'name' => 'address',
                            'label' => 'Address',
                            'data-key' => 'Address',
                            'rows' => '3',
                            'class' => 'form-control form-control-sm override-textarea',
                            'text' => $user->address ?? '',
                        ]"
                    />
                </div>
            </div>
        @else
            {{-- Other User Types Fields --}}
            <div class="row">
                <div class="col-md-6">
                    <x-input 
                        :attrib="[
                            'name' => 'company_code',
                            'label' => 'Company Code',
                            'data-key' => 'CompanyCode',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->company_code ?? '',
                        ]"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-input 
                        :attrib="[
                            'name' => 'name',
                            'label' => 'Name',
                            'data-key' => 'Name',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->name ?? '',
                        ]"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-input 
                        :attrib="[
                            'name' => 'email',
                            'label' => 'Email',
                            'type' => 'email',
                            'data-key' => 'Email',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->email ?? '-',
                        ]"
                    />
                </div>
                <div class="col-md-6">
                    <x-input 
                        :attrib="[
                            'name' => 'contact',
                            'label' => 'Contact',
                            'data-key' => 'Contact',
                            'class' => 'form-control form-control-sm override-input',
                            'value' => $user->contact ?? '',
                        ]"
                    />
                </div>
            </div>
        @endif
        
</x-modal>

@include('partials.auth.footer')

<script>
    // Pass current user data to JavaScript
    window.currentUserData = {
        name: @json($user->name ?? ''),
        email: @json($user->email ?? ''),
        phone: @json($user->phone ?? $user->contact ?? ''),
        contact: @json($user->contact ?? ''),
        company_code: @json($user->company_code ?? ''),
        company: @json($user->company ?? $user->name ?? ''),
        contact_person: @json($user->contact_person ?? ''),
        address: @json($user->address ?? ''),
        first_name: @json($user->first_name ?? ''),
        last_name: @json($user->last_name ?? ''),
    };
</script>
<script src="{{ asset('assets/acrtfm/js/modules/profile.js') }}"></script>

<style>
    .profile-avatar img {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    dt {
        font-weight: 600;
        color: #555;
    }
    dd {
        margin-bottom: 0.75rem;
    }
    .badge-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
</style>

