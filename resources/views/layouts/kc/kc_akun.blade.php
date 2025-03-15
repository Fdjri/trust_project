@extends('layouts/kc/main')
@vite('resources/css/app.css')

@section('content')

<main class="ml-auto w-4/5 md:w-3/4 lg:w-4/5 h-full flex flex-col overflow-y-auto">
        <div class="container">
            <div class="flex items-center space-x-3 mb-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 mr-3 text-gray-800">
                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                    <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                </svg>
                <h2 class="text-2xl font-bold mb-1 text-gray-800">Manage Akun Salesman</h2>
            </div>

            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                        <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="pl-8.75 text-sm ease-soft w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Search..." />
                    </div>
                </div>
            </div>

            <div class="max-w-full overflow-x-auto overflow-y-auto max-h-[500px]">
                <table class="min-w-max bg-white border border-gray-300 shadow rounded text-sm">
                    <thead class="bg-gray-300 text-black">
                        <tr>
                            <th class="px-4 py-2 text-center font-semibold">ID</th>
                            <th class="px-4 py-2 text-center font-semibold">Username</th>
                            <th class="px-4 py-2 text-center font-semibold">Role</th>
                            <th class="px-4 py-2 text-center font-semibold">Status</th>
                            <th class="px-4 py-2 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 transition duration-200">
                            <td class="px-3 py-2 text-center">1</td>
                            <td class="px-3 py-2 text-center">fadjri</td>
                            <td class="px-3 py-2 text-center">sales</td>
                            <td class="px-3 py-2 text-center">
                                <button class="bg-yellow-500 text-white py-1 px-2 rounded shadow hover:bg-yellow-600 transition">
                                    Aktif
                                </button>
                            </td>
                            <td class="px-3 py-2 flex justify-center space-x-2">
                                <button class="bg-gray-400 text-white px-2 py-2 rounded shadow hover:bg-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="size-5">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white px-2 py-2 rounded shadow hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <footer class="pt-2">
        <div class="flex flex-col items-end px-6 py-3">
            <span class="text-sm text-gray-700 mb-2">
                Showing <span class="font-semibold text-gray-700">1</span> to
                <span class="font-semibold text-gray-700">10</span> of
                <span class="font-semibold text-gray-700">100</span> Entries
            </span>

            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-sm">
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight
                        text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg
                        hover:bg-gray-100 hover:text-gray-700">
                            Previous
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight
                        text-blue-600 bg-white border border-gray-300 hover:bg-blue-100 hover:text-blue-700">
                            1
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight
                        text-gray-500 border border-gray-300 bg-gray-50 hover:bg-gray-100 hover:text-gray-700">
                            2
                        </a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8
                        text-gray-500 border border-gray-300 bg-gray-50 hover:bg-gray-100 hover:text-gray-700">
                            3
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight
                        text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="w-full px-6 mx-auto mb-5">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                <div class="w-full max-w-full px-3 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                    <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        CAR DEAL. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</main>

@endsection
