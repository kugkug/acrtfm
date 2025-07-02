@include('partials.clients.headers')
    
    <section class="container">
        <div class="row justify-content-around">
            <div class="col-md-3 mt-2">
                <a href="/ask-ai">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-robot"></i>
                            <p class="mt-3">Ask AI</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mt-2">
                <a href="/airconditioners">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-search"></i>
                            <p class="mt-3">{{ strtoupper($app_module_list['model_lookup']['label'])}}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-2">
                <a href="/manufacturers">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-industry"></i>
                            <p class="mt-3">{{ strtoupper($app_module_list['manufacturers']['label']) }}</p>
                            
                        </div>
                    </div>
                </a>
            </div>
            

            
            
        </div>

        <div class="row justify-content-around">
            <div class="col-md-3 mt-2">
                <a href="/education">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-book-reader"></i>
                            <p class="mt-3">{{ strtoupper($app_module_list['education']['label'])}}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mt-2">
                <a href="/discussions">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-comments"></i>
                            <p class="mt-3">{{ strtoupper($app_module_list['discussions']['label'])}}</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3 mt-2">
                <a href="/ask-an-expert">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-user-tie"></i>
                            <p class="mt-3">{{ strtoupper($app_module_list['ask_an_expert']['label'])}}</p>
                        </div>
                    </div>
                </a>
            </div>

            
        </div>
        <div class="row justify-content-around">
            <div class="col-md-3 mt-2">
                <a href="/interesting-finds">
                    <div class="small-box bg-default box-button">
                        <div class="inner text-center">
                            <i class="fas fa-search-location"></i>
                            <p class="mt-3">{{ strtoupper($app_module_list['interesting_finds']['label'])}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- <x-news /> --}}
@include('partials.clients.footers')