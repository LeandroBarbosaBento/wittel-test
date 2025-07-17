<template>
    <div>
        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-white text-lg font-semibold">
                    Wittel App
                </div>
                <div>
                    <router-link to="/" class="text-gray-300 hover:text-white px-3 py-2 rounded">
                        Home
                    </router-link>
                    <router-link to="/dashboard" class="text-gray-300 hover:text-white px-3 py-2 rounded">
                        Dashboard
                    </router-link>
                </div>
            </div>
        </nav>
        <main class="container mx-auto p-2">
            <slot />
        </main>
        <footer class="bg-gray-800 text-white text-center p-4 mt-6">
             Wittel Test
        </footer>
    </div>
</template>
