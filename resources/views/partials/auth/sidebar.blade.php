<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('home') }}" aria-expanded="false">
                    <i class="fa-solid fa-home menu-icon fa-action"></i><span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('model-lookup') }}" aria-expanded="false">
                    <i class="fa-solid fa-magnifying-glass menu-icon fa-action"></i><span class="nav-text">Model Lookup</span>
                </a>            
            </li>
            <li>
                <a href="{{ route('education') }}" aria-expanded="false">
                    <i class="fa-regular fa-video menu-icon fa-action"></i><span class="nav-text">Education</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('ask-ai') }}" aria-expanded="false">
                    <i class="fa-solid fa-robot menu-icon fa-action"></i><span class="nav-text">Ask A.I.</span>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('job-sites') }}" aria-expanded="false">
                    <i class="fa-solid fa-briefcase menu-icon fa-action"></i><span class="nav-text">Job Sites</span>
                </a>
            </li>
            <li>
                <a href="{{ route('troubleshooter') }}" target="_blank" aria-expanded="false">
                    <i class="fa-solid fa-tools menu-icon fa-action"></i><span class="nav-text">Troubleshooter</span>
                </a>
            </li>
            <li>
                <a href="{{ route('nitrogen-calculator') }}" target="_blank" aria-expanded="false">
                    <i class="fa-solid fa-calculator menu-icon fa-action"></i><span class="nav-text">Nitrogen Calculator</span>
                </a>
            </li>
            <li>
                <a href="#" aria-expanded="false" class="has-arrow">
                    <i class="fa-solid fa-truck-fast menu-icon fa-action"></i><span class="nav-text">Tech Dispatch</span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="{{ route('tech-dispatch') }}">
                            <i class="fa-solid fa-chart-line menu-icon fa-action"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tech-dispatch.customers') }}">
                            <i class="fa-solid fa-users menu-icon fa-action"></i><span class="nav-text">Customers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tech-dispatch.work-orders') }}">
                            <i class="fa-solid fa-clipboard-list menu-icon fa-action"></i><span class="nav-text">Work Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tech-dispatch.quotes') }}">
                            <i class="fa-solid fa-file-invoice-dollar menu-icon fa-action"></i><span class="nav-text">Quotes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tech-dispatch.calendar') }}">
                            <i class="fa-solid fa-calendar-days menu-icon fa-action"></i><span class="nav-text">Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>