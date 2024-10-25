<x-app title="Catégories">
    <main class="container-wide space-y-8">
        <section>
            <h1>Toutes les catégories</h1>

            <div class="grid">
                @foreach ($categories as $category)
                    <a href="{{ route('app.categories.show', ['category' => $category->category_id]) }}">
                        {{ $category->category_name }}
                        <small>{{ trans_choice('tracks.count', $category->tracks_count) }}</small> <!-- Utilisez tracks_count -->
                    </a>
                    <div class="description">
                        <div>
                            {{-- Vous pouvez ajouter une description ici si nécessaire --}}
                        </div>
                        <div>
                            <h2>{{ $category->category_name }}</h2>
                            <h3>{{ trans_choice('tracks.count', $category->tracks_count) }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</x-app>
