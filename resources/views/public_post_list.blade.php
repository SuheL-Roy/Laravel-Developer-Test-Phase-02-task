<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800 dark:bg-black dark:text-white/80">
    <div class="min-h-screen flex flex-col justify-center">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl mx-auto">
            <!-- Header -->
            <header class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <span class="text-2xl font-bold">Blog</span>
                </div>

                <nav class="flex space-x-4">
                    <a href="{{ url('/') }}"
                        class="rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100 dark:text-white/90 dark:hover:bg-gray-800">Post
                        List</a>

                    @auth

                        <a class="rounded-md px-3 py-2 bg-blue-600 text-white hover:bg-blue-700"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                            <i class="ph-duotone ph-power"></i>
                            <span>Logout</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 bg-blue-600 text-white hover:bg-blue-700">Log in</a>
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 bg-blue-600 text-white hover:bg-blue-700">Register</a>
                    @endauth
                </nav>
            </header>

            <!-- Blog Posts Section -->
            <div class="container mx-auto my-12">
                <h2 class="mb-8 text-center text-3xl font-bold">Latest Blog Posts</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Blog Post 1 -->
                    @foreach ($all_posts as $item)
                        <div class="blog-card bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover"
                                alt="Blog post image">
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 text-xs font-semibold px-2 py-1 rounded-full">{{ $item->category }}</span>
                                    <span
                                        class="text-gray-500 dark:text-gray-400 text-sm ml-3">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $item->title }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $item->content }}</p>
                                <a href="{{ route('blog_details', ['slug' => $item->slug]) }}"
                                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Read
                                    More</a>
                            </div>
                        </div>
                    @endforeach
                    <!-- Blog Post 2 -->

                </div>


                <div class="flex justify-center mt-12">
                    {{ $all_posts->links() }}
                </div>

            </div>

            <!-- Footer -->
            <footer class="py-12 text-center text-sm text-gray-500 dark:text-white/50">
                <p>© 2025 My Blog. All rights reserved.</p>

            </footer>
        </div>
    </div>
</body>

</html>
