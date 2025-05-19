<!-- resources/views/menus/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">Edit Menu</h1>
        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                <input type="text" id="name" name="name" value="{{ $menu->name }}" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Category -->
            <div>
    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
    <select id="category" name="category" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        @php
            $categories = ['karbo', 'ayam', 'burger', 'nugget', 'minuman', 'paket', 'promo'];
        @endphp
        @foreach ($categories as $category)
            <option value="{{ $category }}" {{ $menu->category === $category ? 'selected' : '' }}>
                {{ ucfirst($category) }}
            </option>
        @endforeach
    </select>
</div>


            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>{{ $menu->description }}</textarea>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="price" name="price" value="{{ $menu->price }}" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Menu</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" accept="image/*">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Menu</button>
            </div>
        </form>
    </div>

</body>
</html>
