@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-950 text-white">
  <div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold mb-4">Hogwarts Houses</h2>
      <p class="text-xl text-gray-300 max-w-3xl mx-auto">Each house has its own unique values and qualities.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
      <div class="bg-red-800 p-6 rounded-lg text-center shadow-lg">
        <img src="{{ asset('images/icons/gryffindor.png') }}" class="mx-auto w-16 h-16 mb-4" alt="Gryffindor" />
        <h3 class="text-xl font-bold mb-2">Gryffindor</h3>
        <p>Bravery, courage, and chivalry.</p>
      </div>
      <div class="bg-green-800 p-6 rounded-lg text-center shadow-lg">
        <img src="{{ asset('images/icons/slytherin-icon.png') }}" class="mx-auto w-16 h-16 mb-4" alt="Slytherin" />
        <h3 class="text-xl font-bold mb-2">Slytherin</h3>
        <p>Ambition, cunning, and resourcefulness.</p>
      </div>
      <div class="bg-yellow-600 p-6 rounded-lg text-center shadow-lg">
        <img src="{{ asset('images/icons/hufflepuff-icon.png') }}" class="mx-auto w-16 h-16 mb-4" alt="Hufflepuff" />
        <h3 class="text-xl font-bold mb-2">Hufflepuff</h3>
        <p>Loyalty, patience, and dedication.</p>
      </div>
      <div class="bg-blue-800 p-6 rounded-lg text-center shadow-lg">
        <img src="{{ asset('images/icons/ravenclaw-icon.png') }}" class="mx-auto w-16 h-16 mb-4" alt="Ravenclaw" />
        <h3 class="text-xl font-bold mb-2">Ravenclaw</h3>
        <p>Wisdom, wit, and creativity.</p>
      </div>
    </div>
  </div>
</section>
@endsection
