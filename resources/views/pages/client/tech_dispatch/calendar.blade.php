@include('partials.auth.header')

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Calendar & Scheduling</h4>
                    <p class="card-text">Schedule and manage appointments</p>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-plus me-2"></i>Schedule Appointment
                            </button>
                            <button class="btn btn-info me-2" type="button">
                                <i class="fa fa-calendar-day me-2"></i>Today
                            </button>
                            <button class="btn btn-secondary me-2" type="button">
                                <i class="fa fa-calendar-week me-2"></i>Week
                            </button>
                            <button class="btn btn-secondary" type="button">
                                <i class="fa fa-calendar-alt me-2"></i>Month
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-select">
                                    <option>All Technicians</option>
                                    <option>Mike Johnson</option>
                                    <option>David Brown</option>
                                    <option>Lisa Garcia</option>
                                    <option>Tom Wilson</option>
                                </select>
                                <input type="date" class="form-control">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Calendar View -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Today's Schedule</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">AC Repair - John Smith</h6>
                                                <small>9:00 AM</small>
                                            </div>
                                            <p class="mb-1">123 Main St, New York</p>
                                            <small>Technician: Mike Johnson</small>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Maintenance - Sarah Wilson</h6>
                                                <small>11:30 AM</small>
                                            </div>
                                            <p class="mb-1">456 Oak Ave, Los Angeles</p>
                                            <small>Technician: David Brown</small>
                                        </div>
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Installation - Robert Davis</h6>
                                                <small>2:00 PM</small>
                                            </div>
                                            <p class="mb-1">789 Pine Rd, Chicago</p>
                                            <small>Technician: Lisa Garcia</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Quick Stats</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <h4 class="text-primary">8</h4>
                                            <small>Today's Appointments</small>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="text-success">5</h4>
                                            <small>Completed</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<!-- Calendar JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
                title: 'AC Repair - John Smith',
                start: '2024-01-15T09:00:00',
                end: '2024-01-15T11:00:00',
                color: '#007bff'
            },
            {
                title: 'Maintenance - Sarah Wilson',
                start: '2024-01-15T11:30:00',
                end: '2024-01-15T13:30:00',
                color: '#28a745'
            },
            {
                title: 'Installation - Robert Davis',
                start: '2024-01-15T14:00:00',
                end: '2024-01-15T16:00:00',
                color: '#ffc107'
            }
        ]
    });
    calendar.render();
});
</script>

@include('partials.auth.footer')
