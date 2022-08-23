<template>
<div>
    <div class="container sticky top-0 z-sticky">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 flex-0">
                <!-- Navbar -->
                <nav
                    class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center px-4 py-2 m-6 mb-0 shadow-sm rounded-xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start">
                    <div class="flex items-center justify-between w-full p-0 px-6 mx-auto flex-wrap-inherit">
                        <span class="py-1.75 text-size-base mr-4 ml-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0">
                            By Bou
                        </span>
                        <button navbar-trigger=""
                            class="px-3 py-1 ml-2 leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-size-lg lg:hidden"
                            type="button" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span
                                class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6-em h-6-em bg-none">
                                <span bar1=""
                                    class="w-5.5 rounded-xs relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                                <span bar2=""
                                    class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                                <span bar3=""
                                    class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                            </span>
                        </button>
                        <div navbar-menu=""
                            class="items-center flex-grow transition-all duration-500 lg-max:overflow-hidden ease lg-max:max-h-0 basis-full lg:flex lg:basis-auto">
                            <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
                                <li>
                                    <span class="flex items-center px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-size-sm text-slate-700 lg:px-2"
                                        aria-current="page" href="../pages/dashboard.html">
                                        <i class="mr-1 fa fa-chart-pie opacity-60" aria-hidden="true"></i>
                                        <router-link :to="{ name: 'home' }">Home</router-link>
                                    </span>
                                </li>
                                <li>
                                    <span class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-size-sm text-slate-700 lg:px-2">
                                        <i class="mr-1 fas fa-user-circle opacity-60" aria-hidden="true"></i>
                                        <router-link :to="{ name: 'register' }">Register</router-link>
                                    </span>
                                </li>
                                <li>
                                    <span class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-size-sm text-slate-700 lg:px-2">
                                        <i class="mr-1 fas fa-key opacity-60" aria-hidden="true"></i>
                                        <router-link :to="{ name: 'login' }">Login</router-link>
                                    </span>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </nav>
                <!-- Navbar -->
            </div>
        </div>
    </div>
    <main class="mt-0 transition-all duration-200 ease-in-out">
        <router-view></router-view>
    </main>
</div>
</template>
