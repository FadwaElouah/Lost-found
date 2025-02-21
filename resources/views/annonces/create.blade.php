@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
    <h1 class="text-2xl font-bold text-gray-800">{{ isset($annonce) ? 'Modifier' : 'Créer' }} une annonce</h1>

    <form action="{{ isset($annonce) ? route('annonces.update', $annonce->id) : route('annonces.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
        @csrf
        @if(isset($annonce)) @method('PUT') @endif

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $annonce->titre ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Description</label>
            <textarea name="description" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $annonce->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Catégorie</label>
            <input type="text" name="categorie" value="{{ old('categorie', $annonce->categorie ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Lieu</label>
            <input type="text" name="lieu" value="{{ old('lieu', $annonce->lieu ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Date</label>
            <input type="date" name="date_perdu_trouve" value="{{ old('date_perdu_trouve', $annonce->date_perdu_trouve ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $annonce->contact_email ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Téléphone</label>
            <input type="text" name="contact_telephone" value="{{ old('contact_telephone', $annonce->contact_telephone ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Image</label>
            <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            @if(isset($annonce) && $annonce->image)
                <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image actuelle" class="mt-2 w-32 h-32 object-cover rounded-lg">
            @endif
        </div>

        <button type="submit" class="w-full bg-blue-500 text-black py-2 px-4 rounded-lg hover:bg-blue-600 transition">
            {{ isset($annonce) ? 'Modifier' : 'Publier' }}
        </button>
    </form>
</div>
@endsection
