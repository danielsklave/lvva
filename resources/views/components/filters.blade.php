<button 
    id="dropdownSmallButton"
    data-dropdown-toggle="dropdownSmall"
    class="btn-sm"
    type="button"
>
    Filtri <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
</button>

<div id="dropdownSmall" class="hidden z-10 bg-white rounded shadow">
    <form 
        class="p-4 space-y-2" 
        action="{{ $route }}"
        method="GET"
    >
        <x-input 
            label="Virsraksts"
            name="search"
            value="{{ Request::get('search') }}"
        />

        <x-date-select
            label="Datums no"
            name="date_from"
            value="{{ Request::get('date_from') ?: ' ' }}"
        />

        <x-date-select
            label="Datums līdz"
            name="date_to"
            value="{{ Request::get('date_to') ?: ' ' }}"
        />

        <div class="flex gap-2 !mt-4">
            <button type="submit" class="btn-sm">
                Meklēt 
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <a href="{{ $route }}" class="btn-sm">
                Noņemt
                <i class="fa-solid fa-xmark"></i>
            </a>
        </div>
    </form>
</div>