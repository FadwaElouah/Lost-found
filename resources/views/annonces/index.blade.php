@extends('layouts.app')

@section('content')
<!-- Hero Section avec design moderne -->
<div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 h-72">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative max-w-5xl left-0 px-8 h-full  items-start text-white text-left pt-8 pb-8">


        <a href="{{ route('annonces.create') }}" class="group inline-flex items-center px-8 py-4  bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition-colors font-semibold shadow-lg transition transform hover:scale-105 hover:shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Ajouter une annonce
        </a>


    </div>
</div>

<!-- Notification de succès avec design moderne -->
@if(session('success'))
    <div id="success-alert" class="max-w-5xl mx-auto mt-6 mb-2 px-8">
        <div class="p-4 bg-white border border-green-100 text-green-700 rounded-lg shadow-sm animate-fadeIn">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    </script>
@endif

<!-- Affichage des annonces avec design moderne -->
@if(!$annonces->isEmpty())
    <div class="max-w-5xl mx-auto px-8 my-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($annonces as $annonce)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full border border-gray-100">
                    <div class="relative">
                        @if ($annonce->image)
                            <img src="{{ asset('storage/' . $annonce->image) }}" class="w-full h-48 object-cover rounded-t-2xl" alt="{{ $annonce->titre }}">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 rounded-t-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-1.5 bg-white text-sm font-medium rounded-full shadow-sm {{ $annonce->type == 'perdu' ? 'text-red-600' : 'text-green-600' }}">
                                {{ $annonce->type == 'perdu' ? 'Perdu' : 'Trouvé' }}
                            </span>
                        </div>
                        @if($annonce->premium)
                            <div class="absolute top-4 right-4">
                                <span class="px-4 py-1.5 bg-gradient-to-r from-amber-400 to-amber-300 text-amber-900 text-sm font-medium rounded-full shadow-sm flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Premium
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium px-3 py-1 rounded-full bg-blue-50 text-blue-600">
                                {{ $annonce->categorie ?? 'Non catégorisé' }}
                            </span>
                            <span class="text-sm text-gray-400">{{ $annonce->created_at->diffForHumans() }}</span>
                        </div>

                        <h5 class="text-lg font-semibold mb-2 text-gray-900">{{ $annonce->titre }}</h5>
                        <p class="text-gray-600 mb-4 line-clamp-2 text-sm">{{ Str::limit($annonce->description, 120) }}</p>

                        @if($annonce->lieu)
                            <div class="flex items-center mt-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-500 text-sm">{{ $annonce->lieu }}</span>
                            </div>
                        @endif
   <!-- Section commentaires avec nouveau design -->
   <div class="mt-3 pt-3 border-t border-gray-100">
    <h4 class="text-xs font-semibold text-gray-900 mb-2">Commentaires ({{ $annonce->commentaires->count() }})</h4>
    <div class="space-y-2 max-h-24 overflow-y-auto mb-2">
        @foreach($annonce->commentaires->take(2) as $commentaire)
            <div class="bg-gray-50 p-2 rounded">
                <p class="text-xs text-gray-700">
                    <span class="font-medium text-gray-900">{{ $commentaire->user->name }}:</span>
                    {{ Str::limit($commentaire->content, 50) }}
                </p>
            </div>
        @endforeach
    </div>

    @auth
        <form action="{{ route('commentaires.store', $annonce->id) }}" method="POST" class="mt-2">
            @csrf
            <div class="flex items-center space-x-2">
                <input
                    type="text"
                    name="contenu"
                    class="w-full text-xs p-2 border border-gray-200 rounded focus:ring-1 focus:ring-red-500 focus:border-red-500"
                    placeholder="Ajouter un commentaire..."
                    required
                >
                <button type="submit" class="px-3 py-2 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition-colors">
                    Envoyer
                </button>
            </div>
        </form>
    @else
        <p class="text-xs text-gray-500 mt-2">
            <a href="{{ route('login') }}" class="text-red-600 hover:underline">Connectez-vous</a> pour commenter.
        </p>
    @endauth
</div>

                        <a href="{{ route('annonces.show', $annonce->id) }}" class="mt-6 text-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                            Voir l'annonce
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@endsection
