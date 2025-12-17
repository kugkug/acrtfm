<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('home') }}" aria-expanded="false">
                    <i class="fa-solid fa-home menu-icon menu-icon--home fa-action"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('model-lookup') }}" aria-expanded="false">
                    <i class="fa-solid fa-magnifying-glass menu-icon menu-icon--model-lookup fa-action"></i><span class="nav-text">Model Lookup</span>
                </a>            
            </li>
            <li>
                <a href="{{ route('education') }}" aria-expanded="false">
                    <i class="fa-solid fa-video menu-icon menu-icon--education fa-action"></i><span class="nav-text">Education</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('ask-ai') }}" aria-expanded="false">
                    <i class="fa-solid fa-robot menu-icon fa-action"></i><span class="nav-text">Ask A.I.</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('job-sites') }}" aria-expanded="false">
                    <i class="fa-solid fa-briefcase menu-icon menu-icon--job-sites fa-action"></i><span class="nav-text">Job Sites</span>
                </a>
            </li>
            <li>
                <a href="{{ route('troubleshooter') }}" target="_blank" aria-expanded="false">
                    <i class="fa-solid fa-tools menu-icon menu-icon--troubleshooter fa-action"></i><span class="nav-text">Troubleshooter</span>
                </a>
            </li>
            <li>
                <a href="{{ route('nitrogen-calculator') }}" target="_blank" aria-expanded="false">
                    <i class="fa-solid fa-calculator menu-icon menu-icon--nitrogen-calculator fa-action"></i>
                    <span class="nav-text">Nitrogen Calculator</span>
                </a>
            </li>

            @if (URL::to('/') != 'https://acrtfm.com')
                
                @if (auth()->user()->user_type == config('acrtfm.user_types.company'))
                <li>
                    <a href="#" aria-expanded="false" class="has-arrow">
                        <i class="fa-solid fa-truck-fast menu-icon menu-icon--tech-dispatch fa-action"></i>
                        <span class="nav-text">Tech Dispatch</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <a href="{{ route('tech-dispatch') }}">
                                <i class="fa-solid fa-chart-line menu-icon menu-icon--tech-dispatch-dashboard fa-action"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers') }}">
                                <i class="fa-solid fa-users menu-icon menu-icon--tech-dispatch-customers fa-action"></i>
                                <span class="nav-text">Customers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('work-orders') }}">
                                <i class="fa-solid fa-clipboard-list menu-icon menu-icon--tech-dispatch-work-orders fa-action"></i>
                                <span class="nav-text">Work Orders</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('technicians') }}">
                                <i class="fa-solid fa-user-gear menu-icon menu-icon--tech-dispatch-technicians fa-action"></i>
                                <span class="nav-text">Technicians</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tech-dispatch.quotes') }}">
                                <i class="fa-solid fa-file-invoice-dollar menu-icon menu-icon--tech-dispatch-quotes fa-action"></i>
                                <span class="nav-text">Quotes</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('tech-dispatch.calendar') }}">
                                <i class="fa-solid fa-calendar-days menu-icon fa-action"></i>
                                <span class="nav-text">Calendar</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                @elseif (Auth::user()->user_type == config('acrtfm.user_types.technician'))
                <li>
                    <a href="{{ route('work-orders') }}">
                        <i class="fa-solid fa-clipboard-list menu-icon menu-icon--work-orders fa-action"></i>
                        <span class="nav-text">Work Orders</span>
                    </a>
                </li>
                @endif
            @endif
        </ul>
    </div>
</div>