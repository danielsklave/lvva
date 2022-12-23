<!-- Navigation -->
<nav>
    <div class="sm:flex space-y-4 sm:space-y-0 justify-between items-center px-4 md:px-6 py-4 md:my-2">
        <a href="/" class="flex items-center space-x-4">
            <img src="{{ url('/images/LVVA.png') }}" class="max-h-8 md:max-h-16" alt="Image"/>
            <h1 class="md:text-2xl font-bold text-red-800">Latvijas Vieglatlētikas vecmeistaru asociācija</h1>
        </a>
        <div class="flex gap-8">
          <a href="{{ route('news.index') }}">
            <i class="fa-solid fa-newspaper fa-2xl text-sky-800 mr-1"></i>
            <span class="text-sky-800 font-bold text-lg">Ziņas</span>
          </a>
          <a href="{{ route('albums.index') }}">
            <i class="fa-solid fa-images fa-2xl text-sky-800 mr-1"></i>
            <span class="text-sky-800 font-bold text-lg">Galerija</span>
          </a>
          <a href="https://www.facebook.com/profile.php?id=100063962657479">
            <i class="fa-brands fa-facebook fa-2xl text-sky-800"></i>
          </a>
        </div>
    </div>
</nav>

<nav class="p-4 md:p-2 bg-sky-800">
  <div class="flex flex-wrap items-center">
    <button data-collapse-toggle="navbar-solid-bg" type="button" class="inline-flex justify-center items-center ml-3 text-gray-400 rounded-lg md:hidden hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300" aria-controls="navbar-solid-bg" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
      <ul class="mx-2 flex flex-col align-items-center mt-4 bg-sky-800 md:flex-row md:space-x-1 md:mt-0 md:font-medium md:bg-transparent">
        <li class="nav-item dropdown">
          <button id="dropdownNavbarLink1" data-dropdown-toggle="dropdownNavbar1" class="flex justify-between items-center py-2 px-4 text-white rounded hover:bg-sky-700 md:bg-transparent">
            Par mums
            <svg class="ml-1 w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
          <!-- Dropdown menu -->
          <div id="dropdownNavbar1" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow">
            <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton1">
              <li>
                <a href="{{ route('about.contacts') }}" class="block py-2 px-4 hover:bg-gray-100">
                  Kontakti
                </a>
              </li>
              <li>
                <a href="{{ route('board_meetings.index') }}" class="block py-2 px-4 hover:bg-gray-100">
                  Valde
                </a>
              </li>
              <li>
                <a href="http://www.lvva.lv/nolikumi/22/LVVA%20biedru%20saraksts%20(10%2009%202022).pdf" target="_blank" class="block py-2 px-4 hover:bg-gray-100">
                  Juridiskie biedri
                </a>
              </li>
              <li>
                <a href="{{ route('member_meetings.index') }}" class="block py-2 px-4 hover:bg-gray-100">
                  Biedru sapulces
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li>
          <a href="{{ route('tournaments.index') }}" class="block py-2 px-4 text-white rounded hover:bg-sky-700 md:bg-transparent">
            Sacensības
          </a>
        </li>
        <li>
          <a href="{{ route('records') }}" class="block py-2 px-4 text-white rounded hover:bg-sky-700 md:bg-transparent">
            Rekordi
          </a>
        </li>
        <li>
          <a href="{{ route('contests.index') }}" class="block py-2 px-4 text-white rounded hover:bg-sky-700 md:bg-transparent">
            LVVA konkurss
          </a>
        </li>
        <li>
          <a href="{{ route('antidoping') }}" class="block py-2 px-4 text-white rounded hover:bg-sky-700 md:bg-transparent">
            Antidopings
          </a>
        </li>
        @auth
            <li class="nav-item dropdown">
                <button id="dropdownNavbarLink4" data-dropdown-toggle="dropdownNavbar4" class="flex justify-between items-center py-2 px-4 text-white rounded hover:bg-sky-700 md:bg-transparent">
                  {{ auth()->user()->name }} 
                  <svg class="ml-1 w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownNavbar4" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow">
                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                      <!-- <li>
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-gray-100">
                          Dashboard
                        </a>
                      </li> -->
                      <!-- <li>
                        <a href="{{ route('profile') }}" class="block py-2 px-4 hover:bg-gray-100">
                          Profils
                        </a>
                      </li> -->
                      <li>
                        <a href="{{ route('posts.index') }}" class="block py-2 px-4 hover:bg-gray-100">
                          Saturs
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('comments.index') }}" class="block py-2 px-4 hover:bg-gray-100">
                          Komentāri
                        </a>
                      </li>
                    </ul>
                    <div class="py-1">
                      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">
                        Izraksīties
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </div>
                </div>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}" class="block py-2 pr-4 pl-3 text-white rounded hover:bg-sky-700 md:bg-transparent">Autorizēties</a>
            </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>