
<div class="cabin font-semibold flex flex-col justify-center lg:max-w-5xl sm:max-w-xl max-sm:w-80 mx-auto md:p-4 max-md:p-3 bg-white rounded-md shadow-md">
  
  <form action="{{ route('voituresDisponibles')}}" method="post">
    @csrf
    <div class="grid lg:grid-cols-2 grid-cols-1 justify-center max-lg:gap-2">

        @livewire('ChercherLieu') 

        <div class="flex flex-row max-sm:flex-col w-full max-lg:gap-2">
            <label for="dateDepart" class="w-full">
              <input id="dateTime1" name="dateDepart" type="text" placeholder="Date de départ"
              class="p-3 w-full cursor-pointer focus:ring-0 border-2 border-slate-300 focus:border-teal-500 max-lg:rounded-lg lg:border-l-0">
              @error('dateDepart') <p class="text-red-600 text-sm p-2">{{ $message }}</p> @enderror
            </label>
            <label for="dateRetour" class="w-full">
              <input id="dateTime2" name="dateRetour" type="text" placeholder="Date de retour"
              class="p-3 w-full cursor-pointer focus:ring-0 border-2 border-slate-300 focus:border-teal-500 max-lg:rounded-lg lg:border-l-0 lg:rounded-r-xl">
              @error('dateRetour') <p class="text-red-600 text-sm p-2">{{ $message }}</p> @enderror
            </label>
        </div>

    </div>
    <div class="flex flex-row align-middle justify-between pt-2 text-sm mx-2">
      <div class="flex flex-row gap-2 place-items-center">
        <p>Mon age :</p>
        <select name="minAge" class="border-none focus:border-none">
          @for($i = 18; $i <= 25; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
          @endfor
            <option value="26" selected>26+</option>
        </select>      
      </div>
      <input type="submit" value="Rechercher" class="px-5 py-2 bg-teal-500 hover:bg-teal-600 text-white cursor-pointer font-semibold rounded-lg shadow-md uppercase transition-all">
    </div>
  </form> 
</div>

@once
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    flatpickr('#dateTime1' , {
      enableTime: true,
      dateFormat: "d-m-Y H:i",
      minTime: "06:00",
      maxTime: "01:00",
      defaultDate:new Date().fp_incr(1),
      defaultHour:12,
      defaultMinute:30,
    });

    flatpickr('#dateTime2' , {
      enableTime: true,
      dateFormat: "d-m-Y H:i",
      minTime: "06:00",
      maxTime: "01:00",
      defaultDate:new Date().fp_incr(2),
      defaultHour:12,
      defaultMinute:30,
    });
  </script>
@endonce