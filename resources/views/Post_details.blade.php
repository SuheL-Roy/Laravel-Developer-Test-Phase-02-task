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
    <div class="min-h-screen flex flex-col">
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
            
            <!-- Breadcrumb Navigation -->
           
            
            <!-- Blog Post Details -->
            <div class="max-w-4xl mx-auto mb-12">
                <!-- Feature Image -->
                <div class="rounded-lg overflow-hidden shadow-lg mb-6">
                    <img src="{{ asset('storage/' . $blog_details->image) }}" class="w-full h-64 md:h-80 object-cover" alt="Blog post feature image">
                </div>
                
                <!-- Post Header -->
                <div class="mb-8">
                    <div class="flex items-center mb-3">
                        <span class="bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 text-xs font-semibold px-3 py-1 rounded-full">{{ $blog_details->category }}</span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm ml-4">{{ \Carbon\Carbon::parse($blog_details->created_at)->format('F d, Y') }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-white">{{ $blog_details->title }}</h1>
                    
                  
                </div>
                
                <!-- Post Content -->
                <div class="prose max-w-none dark:prose-invert text-gray-700 dark:text-gray-300">
                    <p class="mb-6">{{ $blog_details->content }}</p>
                    
                  
                   
                  
                </div>
                
              
            </div>
            
          
            
           
             