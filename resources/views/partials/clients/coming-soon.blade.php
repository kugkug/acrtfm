@include('partials.clients.headers')

  <!--Main Navigation-->
  <header>
    <!-- Intro settings -->
    <style>
      /* Default height for small devices */
      #intro {
        height: 600px;
        /* Margin to fix overlapping fixed navbar */
        
      }
      @media (max-width: 991px) {
              #intro {
              /* Margin to fix overlapping fixed navbar */
              margin-top: 45px;
      	}
      }
    </style>


    <!-- Background image -->
    <div id="intro" class="p-5 text-center bg-image shadow-1-strong"
      style="background-image: url('{{asset('images/logo2.jpg')}}'); background-size: cover;">
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="text-white px-4" data-mdb-theme="dark">
            <h1 class="mb-3">Coming Soon!</h1>

          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  
@include('partials.clients.footers')