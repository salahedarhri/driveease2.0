<div x-data="{ navbar:false ,sticky:$refs.filtres.offsetTop }" @scroll.window="navbar=(window.pageYOffset > sticky)?true:false">
    @include('composants.formulaireRecap')


    {{-- Chargement --}}
    <div wire:loading class="fixed z-20 inset-0 bg-white bg-opacity-90 transition-all">
        <div class="w-full h-screen flex flex-col justify-center place-items-center">
            <span class="loading loading-spinner loading-lg text-teal-600"></span>
            <p class="mt-2 font-semibold text-lg">Chargement...</p>
        </div>
    </div>


    {{-- Total avec Validation & Sticky Component--}}
    <div x-ref="filtres" x-bind:class="navbar?'fixed top-0':''" class="w-full bg-white shadow-xl">
        <div
            class="flex flex-row justify-between max-md:justify-center place-items-center max-w-5xl mx-auto md:p-2 md:px-3 max-md:p-1 max-md:px-2 font-montserrat">
            <p class="text-xl max-md:hidden font-semibold ">Choisissez votre franchise et vos options</p>

            <div class="flex flex-row place-items-center  md:gap-6 max-md:gap-2 text-lg md:p-2 max-md:p-1">
                @if(isset($voiture) && isset($protectionChoisi) && isset($optnsIds))
                <div class="flex flex-row gap-1">
                    <p class="font-semibold">Total : </p>
                    <p class="font-semibold text-teal-600">{{ ($voiture->prix * $nbJrs) + $prixPrtc + $prixOptns }} Dh
                    </p>
                </div>
                @elseif( isset($voiture) && isset($protectionChoisi))
                <div class="flex flex-row gap-1">
                    <p class="font-semibold">Total :</p>
                    <p class="font-semibold text-teal-600"> {{ ($voiture->prix * $nbJrs) + $prixPrtc }} Dh</p>
                </div>
                @else
                <p> ---- </p>
                @endif
                <a href="{{ route('finaliserReservation',[
                        'dateDepart'=> $dateDepart,
                        'dateRetour'=> $dateRetour,
                        'lieuDepart'=> $lieuDepart,
                        'lieuRetour'=> $lieuRetour,
                        'minAge'=> $minAge,
                        'voiture' => $voiture->slug,
                ]) }}"
                    class="text-white bg-teal-600 hover:bg-teal-500 transition-all rounded-lg shadow-lg py-2 px-4 font-semibold">Valider</a>
            </div>
        </div>
    </div>

    <div class="w-full bg-slate-200 px-4 max-md:px-2">

        <div class="max-w-7xl mx-auto p-4 max-sm:p-1 font-cabin">

            <p class="font-montserrat text-2xl max-sm:text-xl text-mediumBlue font-bold md:px-3 md:py-5 max-md:px-2 max-md:py-2">Nos franchises</p>
            {{-- Section Franchises --}}
            <div class="grid grid-cols-3 md:gap-3 max-md:gap-1 max-lg:grid-cols-1 w-full">

                @foreach ($protections as $prtc)
                <div x-data="{ open:false }">

                    @if( isset($protectionChoisi) && $prtc == $protectionChoisi)
                        <div class="bg-teal-100 rounded shadow-lg shadow-teal-600 p-4 max-md:p-2  max-lg:text-center">
                            @else
                            <div class="bg-white rounded shadow-lg p-4 max-md:p-2 max-lg:text-center">
                                @endif

                                <p class="text-2xl max-md:text-lg font-montserrat font-bold py-1">{{ $prtc->type }}

                                    @if ($prtc->type == 'Basique')
                                    <span class="text-teal-500 text-xl font-normal ml-2"><i class="ri-star-s-fill"></i></span>
                                </p>
                                @elseif($prtc->type == 'Medium')
                                <span class="text-teal-500 text-xl font-normal ml-2"><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i></span></p>
                                @elseif($prtc->type == 'Premium')
                                <span class="text-teal-500 text-xl font-normal ml-2"><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i></span></p>
                                @endif

                                <div class="h-24 max-md:h-15 font-montserrat font-semibold text-sm py-5 max-md:py-1 flex flex-col gap-2">
                                    <p class="">Caution minimum : <span>{{ $prtc->prixCaution }} DH</span></p>
                                    <p class="text-cyan-600">Franchise à payer en cas de dommages : <span>{{
                                            $prtc->prixFranchise }} DH</span></p>
                                </div>
                                <div class="flex flex-col gap-2 px-1 py-6 max-md:py-1 mx-auto text-left max-md:text-sm">
                                    @if ($prtc->type == 'Basique')
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection contre les dommages résultant
                                        d'une collision</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection contre le vol</p>
                                    <p class="text-slate-400"><b
                                            class="mr-2 text-red-700 text-opacity-50">&#10006;</b>Protection bris de glace,
                                        phares et pneumatiques</p>
                                    <p class="text-slate-400"><b
                                            class="mr-2 text-red-700 text-opacity-50">&#10006;</b>Protection personnelle
                                        accident (conducteur et passagers)</p>
                                    <p class="text-slate-400"><b
                                            class="mr-2 text-red-700 text-opacity-50">&#10006;</b>Protection des biens
                                        personnels</p>
                                    @elseif($prtc->type == 'Medium')
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection contre les dommages résultant
                                        d'une collision</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection contre le vol</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection bris de glace, phares et
                                        pneumatiques</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection personnelle accident
                                        (conducteur et passagers)</p>
                                    <p class="text-slate-400"><b
                                            class="mr-2 text-red-700 text-opacity-50">&#10006;</b>Protection des biens
                                        personnels</p>
                                    @elseif($prtc->type == 'Premium')
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection contre les dommages résultant
                                        d'une collision</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection contre le vol</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection bris de glace, phares et
                                        pneumatiques</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection personnelle accident
                                        (conducteur et passagers)</p>
                                    <p><b class="text-teal-500 mr-1">&#x2713;</b> Protection des biens personnels</p>
                                    @endif
                                </div>

                                <div class="font-montserrat flex flex-col justify-center align-center text-center pt-4 max-md:pt-1">
                                    @if($prtc->type == 'Basique')
                                    <p class="text-xl text-teal-600">Incluse</p>
                                    @else
                                    <p class="text-xl max-md:text-lg py-1 text-teal-600"><b>{{ $prtc->prix }} DH</b>/Jour</p>
                                    @endif

                                    <div class="flex flex-col gap-2 p-4 max-md:p-1 max-lg:text-center">

                                        @if( isset($protectionChoisi) && $prtc == $protectionChoisi)
                                        <button
                                            class="p-2 font-semibold bg-neutral-500 hover:bg-neutral-600 rounded shadow transition text-white my-4 max-md:my-1  w-full"
                                            disabled>Sélectionnée</button>
                                        @else
                                        <button wire:click="choisirProtection({{ $prtc->id }})"
                                            class="p-2 font-semibold bg-teal-500 hover:bg-teal-600 rounded shadow transition text-white my-4 max-md:my-1 w-full">Sélectionner</button>
                                        @endif
                                        <button wire:key="modal-ouvrir-{{ $prtc->id }}"
                                            class="text-sm font-semibold underline" @click="open =!open">En savoir
                                            plus...</button>
                                    </div>

                                    <div x-cloak x-show="open">
                                        {{-- Modal associé à l'option --}}
                                        @include('composants.modalFranchise')
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="font-montserrat text-2xl max-sm:text-xl text-mediumBlue font-bold px-3 pt-8 pb-4">Nos options
                </p>

                {{-- Section Options --}}
                <div
                    class="grid grid-cols-4 max-xl:grid-cols-3 max-lg:grid-cols-2 max-sm:grid-cols-1 max-w-7xl mx-auto gap-4 max-md:gap-1 md:p-2 max-md:pb-3">

                    @foreach ($options as $optn)

                    <div x-data="{ open:false }">
                        @if( isset($optnsIds) && in_array($optn->id, $optnsIds))

                        {{-- Option sélectionné --}}
                        <div class="bg-teal-100 flex flex-col justify-center md:p-3 max-md:p-2 rounded-lg shadow-lg shadow-teal-600 border border-teal-400">
                            <div class="flex flex-row justify-left gap-2 p-2 h-20 max-md:h-12">
                                <img loading="lazy" src="{{asset('images/options/'. $optn->urlPhoto )}}" alt="{{$optn->urlPhoto}}"
                                    class="w-auto h-16 max-md:h-8 object-center">
                                <p class="text-lg font-bold"> {{ $optn->option}} </p>
                            </div>
                            <div class="flex flex-col gap-3 p-2 h-24">
                                <p class="line-clamp-3">{{ $optn->description }}</p>
                            </div>
                            <div class="flex flex-row justify-between px-2 py-4 max-md:py-1">
                                <button class="underline" @click="open =! open">En savoir plus...</button>
                                <p class="font-semibold text-right text-teal-500"> {{ $optn->prix}} DH/Total</p>
                            </div>

                            <button wire:key="retirer-{{ $optn->id }}" wire:click="RetirerOption({{ $optn->id }})"
                                class="bg-white py-2 px-4 text-teal-500 border-2 border-teal-500 font-semibold shadow rounded font-montserrat md:my-3 max-md:my-1 w-fit self-end">
                                Retirer</button>
                        </div>

                        <div x-cloak x-show="open">

                            {{-- Modal associé à l'option --}}
                            @include('composants.modalOptions')
                        </div>

                        @else
                        {{-- Affichage standard d'Option --}}
                        <div class="bg-white flex flex-col justify-center md:p-3 max-md:p-2 rounded-lg shadow-lg">
                            <div class="flex flex-row justify-left gap-2 p-2 h-20 max-md:h-12">
                                <img loading="lazy" src="{{asset('images/options/'. $optn->urlPhoto )}}" alt="{{$optn->urlPhoto}}"
                                    class="w-auto h-16 max-md:h-8 object-center">
                                <p class="text-lg font-bold"> {{ $optn->option}} </p>
                            </div>
                            <div class="flex flex-col gap-3 p-2 h-24">
                                <p class="line-clamp-3">{{ $optn->description }}</p>
                            </div>
                            <div class="flex flex-row justify-between px-2 py-4 max-md:py-1">
                                <button class="underline" @click="open =! open">En savoir plus...</button>
                                <p class="font-semibold text-right text-teal-500"> {{ $optn->prix}} DH/Total</p>
                            </div>

                            <button wire:key="ajouter-{{ $optn->id }}" wire:click="AjouterOption({{ $optn->id }})"
                                class="py-2 px-4 bg-cyan-500 text-white font-semibold shadow rounded font-montserrat md:my-3 max-md:my-1 w-fit self-end">Sélectionner</button>

                        </div>

                        <div x-cloak x-show="open">
                            {{-- Modal associé à l'option --}}
                            @include('composants.modalOptions')
                        </div>

                        @endif
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>