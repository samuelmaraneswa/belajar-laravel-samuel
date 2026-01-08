<x-layout title="Detail Workout">
  <h1>{{ $workout->title }}</h1>
  <p>{{ $workout->description }}</p>

  <div class="max-w-md">
    @include('svg.body-map-front')
  </div>

  <div class="max-w-md">
    @include('svg.body-map-back')
  </div>

  <h3>Primary Muscle</h3>
  <ul>
  @foreach($workout->muscles->where('pivot.role','primary') as $m)
    <li>{{ $m->name }}</li>
  @endforeach
  </ul>

  <h3>Secondary Muscle</h3>
  <ul>
  @foreach($workout->muscles->where('pivot.role','secondary') as $m)
    <li>{{ $m->name }}</li>
  @endforeach
  </ul>

  <form id="calcForm">
    @csrf

    <input type="hidden" id="workout_slug" value="{{ $workout->slug }}">

    <input type="number" id="weight" placeholder="weight (kg)" required>
    <input type="number" id="age" placeholder="age" required>
    <input type="number" id="height" placeholder="height (cm)" required>

    <select id="gender" required>
      <option value="">-- gender --</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
    </select>

    <button type="submit">Calculate</button>
  </form>

  <div id="resultBox"></div>

  <script>
    window.muscles = {
      primary: @json($workout->muscles->where('pivot.role', 'primary')->pluck('slug')),
      secondary: @json($workout->muscles->where('pivot.role', 'secondary')->pluck('slug')),
    }
  </script>

</x-layout>