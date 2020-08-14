<header>
  <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('images/banner3.png') ;">
       
        <div class="carousel-caption d-none d-md-block">
          <form  action="{{route('guest')}}" method="get">
            @csrf
            <input type="text" class="p-2" name="search" style="width: 80%;border-radius: 10px;" placeholder="Search a lawyer">
              <button class="btn btn-md btn-primary p-2" style="border-radius: 10px;">Search</button>
          </form>
          <h2 class="display-4 mt-2">Lawyer / Law Firms</h2>
          <p class="lead ">Solo Lawyer, Small Firms, Medium and Large Law Firm manage.</p>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('images/banner8.jpg'); ">

        <div class="carousel-caption d-none d-md-block">
          <form  action="{{route('guest')}}" method="get">
            @csrf
            <input type="text" class="p-2" name="search" style="width: 80%;border-radius: 10px;" placeholder="Search a lawyer">
              <button class="btn btn-md btn-primary p-2" style="border-radius: 10px;">Search</button>
          </form>
          <h2 class="display-4">Company / Other Law Users</h2>
          <p class="lead">Everything you need to manage your account.</p>
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('images/1_law3.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <form  action="{{route('guest')}}" method="get">
            @csrf
            <input type="text" class="p-2" name="search" style="width: 80%;border-radius: 10px;" placeholder="Search a lawyer">
              <button class="btn btn-md btn-primary p-2" style="border-radius: 10px;">Search</button>
          </form>
          <h2 class="display-4">Law Schools / Students</h2>
          <p class="lead">Everything you need to manage your Lawschools.</p>
        </div>
      </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</header>
