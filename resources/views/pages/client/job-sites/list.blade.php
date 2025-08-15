@include('partials.auth.header')

<section class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <input type="search" class="form-control override-input" placeholder="Search Job Sites" data-key="JobSites">
        </div>
    </div>

    <div class="row" id="job-sites-list"></div>
</section>

@include('partials.auth.footer')
<script src="{{ asset('assets/acrtfm/js/modules/job-sites.js') }}"></script>