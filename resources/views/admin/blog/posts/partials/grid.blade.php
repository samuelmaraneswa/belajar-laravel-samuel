@forelse ($posts as $post)
  <x-admin.post-card :post="$post" />
@empty
  <div class="col-span-full text-center py-16 text-gray-500">
    Belum ada post. 
  </div>
@endforelse