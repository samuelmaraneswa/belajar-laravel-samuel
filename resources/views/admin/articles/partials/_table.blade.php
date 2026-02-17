<div class="bg-white rounded-xl shadow overflow-x-auto">
  <table class="w-full text-sm">

    <thead class="bg-gray-50 border-b">
      <tr>
        <th class="px-6 py-3">No</th>
        <th class="px-6 py-3">Title</th>
        <th class="px-6 py-3">Status</th>
        <th class="px-6 py-3 text-center">Actions</th>
      </tr>
    </thead>

    <tbody>
      @forelse($articles as $index => $article)
        <tr class="border-b hover:bg-gray-50">

          <td class="px-6 py-4">
            {{ $articles->firstItem() + $index }}
          </td>

          <td class="px-6 py-4 font-medium">
            {{ $article->title }}
          </td>

          <td class="px-6 py-4">
            <span class="px-2 py-1 text-xs rounded
              {{ $article->status === 'published'
                  ? 'bg-green-100 text-green-700'
                  : 'bg-gray-200 text-gray-600' }}">
              {{ ucfirst($article->status) }}
            </span>
          </td>

          <td class="px-6 py-4 text-center space-x-1">

            <button
              class="view-article cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded"
              data-id="{{ $article->id }}">
              View
            </button>

            <button
              class="edit-article cursor-pointer bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded"
              data-id="{{ $article->id }}">
              Edit
            </button>

          </td>

        </tr>
      @empty
        <tr>
          <td colspan="4" class="px-6 py-6 text-center text-gray-500">
            Data tidak ditemukan.
          </td>
        </tr>
      @endforelse
    </tbody>

  </table>
</div>
