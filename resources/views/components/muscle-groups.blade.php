@props(['muscles'])

<div class="my-2">
  <p class="font-bold text-gray-700 mb-2">Explore by Muscle Groups</p>

  <div class="flex gap-6 overflow-x-auto pb-2 scrollbar-hide">
    @foreach($muscles as $muscle)
      <x-muscle-card :name="$muscle['name']" :slug="$muscle['slug']" />
    @endforeach
  </div>
</div>
