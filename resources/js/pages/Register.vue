<template>
    <section class="min-h-screen">
            <div 
                style="background-image: url('../../../assets/img/signup-cover.jpg')"
                class="bg-top relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-cover min-h-50-screen rounded-xl">
                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-zinc-800 to-zinc-700 opacity-60"></span>
                <div class="container z-10">
                    <div class="flex flex-wrap justify-center -mx-3">
                        <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                            <h1 class="mt-12 mb-2 text-white">Welcome!</h1>
                            <p class="text-white">
                                Use these awesome forms to login or create new account in your project for free.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
                    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                        <div
                            class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                            <div class="pt-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                                <h5>Register</h5>
                                    <div class="text-pink-900 text-sm text-center bg-blue-100 p-2" v-if="error">
                                        message
                                    </div>
                            </div>
                            <div class="flex-auto pb-6 px-6">
                                <form role="form text-left" autocomplete="off" @submit.prevent="register" v-if="!success" method="POST">

                                    <div class="mb-4">
                                        <div class="relative top-1 text-xs text-end text-red-500">*</div>
                                        <input type="text" name="name" v-model="name"
                                            class="placeholder:text-gray-500 text-size-sm focus:shadow-primary-outline leading-5.6 ease  w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Name" required/>
                                            <small class=" text-red-500">error</small>
                                    </div>

                                    <div class="mb-4">
                                        <div class=" relative top-1 text-xs text-end text-red-500">*</div>
                                        <input type="email" name="email" v-model="email"
                                            class="placeholder:text-gray-500 text-size-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Email" required/>
                                            <small class=" text-red-500">error</small>
                                    </div>

                                    <div class="mb-4">
                                        <div class=" relative top-1 text-xs text-end text-red-500">*</div>
                                        <input type="text" name="staff_code" v-model="staff_code"
                                            class="placeholder:text-gray-500 text-size-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Staff code" required/>
                                            <small class=" text-red-500">error</small>
                                    </div>

                                    <div class="mb-4">
                                        <div class=" relative top-1 text-xs text-end text-red-500">*</div>
                                        <input type="password" name="password" v-model="password"
                                            class="placeholder:text-gray-500 text-size-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Password" required/>
                                            <small class=" text-red-500">error</small>
                                    </div>

                                    <div class="mb-4">
                                        <div class=" relative top-1 text-xs text-end text-red-500">*</div>
                                        <input type="password" name="password_confirmation" v-model="password_confirmation"
                                            class="placeholder:text-gray-500 text-size-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Password Confirmation" required/>
                                            <small class=" text-red-500">error</small>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="inline-block w-full px-5 py-2.5 mt-6 mb-2 font-bold text-center text-white align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:-translate-y-px hover:shadow-xs leading-normal text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                            Sign up
                                        </button>
                                    </div>

                                    <p class="mt-4 mb-0 leading-normal text-size-sm">
                                        Already have an account?
                                        <a href="" class="font-bold text-slate-700 cursor-pointer">
                                            <router-link :to="{ name: 'login' }">Sign in</router-link>
                                        </a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</template>
<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            error: false,
            errors: {},
            success: false
        };
    },
    methods: {
        register() {
            var app = this
            this.$auth.register({
                params: {
                    name: app.name,
                    email: app.email,
                    password: app.password
                },
                success: function () {
                    app.success = true
                },
                error: function (resp) {
                    app.error = true;
                    app.errors = resp.response.data.errors;
                },
                redirect: null
            });
        }
    }
}
</script>
