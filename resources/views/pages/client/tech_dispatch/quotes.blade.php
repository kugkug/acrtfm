@include('partials.auth.header')


<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <x-card > 
                <x-input :attrib="[
                    'name' => 'search',
                    'placeholder' => 'Search quotes...',
                    'dataKey' => 'search',
                    'class' => 'form-control form-control-sm override-input',
                ]" />
            </x-card>
            
        </div>
    </div>
</section>

@include('partials.auth.footer')
