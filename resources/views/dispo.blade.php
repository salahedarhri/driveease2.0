@extends('layouts.client')

@section('content')

<div class="flex flex-col items-center p-2 my-5 mx-auto text-lg max-w-xl bg-emerald-100 border border-emerald-500">
  <p>Lieu de départ: {{ $lieuDepart }}</p>
  <p>Lieu de retour: {{ $lieuRetour }}</p>
  <p>Date/Heure du Départ: {{ $dateDepartDt }}</p>
  <p>Date/Heure du Retour: {{ $dateRetourDt }}</p>
  <p>Age : {{ $minAge }}</p>
</div>

<div class="container mx-auto p-4 max-w-5xl">

  @if ($voituresDisponibles->isEmpty())
      <p>Aucune voiture disponible pour les critères spécifiés.</p>
  @else

      @foreach ($voituresDisponibles as $car)
          <div x-data="{ open: false }">
            <!-- Car display -->
            <div class="bg-white rounded-t-lg overflow-hidden flex flex-col sm:flex-row p-2 border-b-2">
              <div class="sm:w-1/3 py-4">
                <img src="{{ asset('images/voitures/'.$car->photo)}}" alt="Car Image" class="h-auto w-full p-2">
              </div>
              <div class="sm:w-1/3 px-2 py-4">
                <h2 class="text-2xl font-semibold">{{ $car->modele }}</h2>

                <button @click="open = ! open" class="px-2 py-1 mt-3 rounded-md font-semibold text-emerald-500">Plus de détails &#11033</button>

              </div>
              <div class="sm:w-1/3 p-4 flex flex-col items-right justify-center">
                <div class="text-right">
                  <p class="text-2xl font-semibold text-mediumBlue">{{ $car->prix}} Dh/Jour</p>
                  <button class="font-semibold py-2 px-4 rounded-full bg-lightBlue mt-4 w-36 max-sm:w-full">Sélectionner</button>
                </div>
              </div>
            </div>
            <!-- Car details + gaurantee display -->
            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
                class="rounded-b-lg">

                <div class="grid grid-cols-2 gap-2 justify-evenly p-4">

                  <div class="flex flex-col p-4 bg-slate-100 rounded">
                    <p class="font-bold pb-1">Détails du voiture </p>
                    <div class="flex flex-col p-2">
                      <p>Age minimum : {{ $car->minAge }}</p>
                      <p>Nbre Personnes : {{ $car->nbPers }}</p>
                      <p>Transmission : {{ $car->transmission }}</p>
                      <p>Climatisation : @if( isset( $car->climatisation)){{'Oui'}} @else {{'Non'}}@endif</p>
                      <p class="text-gray-700"> {{ $car->description }} </p>
                    </div>
                  </div>

                  <div class="flex flex-col p-3 bg-slate-100">
                    <p class="font-bold pb-1">Protection inclus</p>

                  </div>

                </div>
            </div>
          </div>
      @endforeach
  @endif

</div>

@endsection