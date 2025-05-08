<script setup lang="ts">
import { Link,usePage } from '@inertiajs/vue3';
import { computed,onMounted, ref,defineComponent } from 'vue';

import logo from '../../../../storage/app/images/blood-donation.png';
import type { NavItem } from '@/types';
import { Button } from '@/components/ui/button';

const isDark = ref(false);

const sidebarNavItems: NavItem[] = [
    {
        title: 'Home',
        href: '/web',
    },
    {
        title: 'About Us',
        href: '/about',
    },
    {
        title: 'Contact',
        href: '/contact',
    },
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';


// const NavLink = defineComponent({
//     props: {
//         href: {
//             type: String,
//             required: true,
//         },
//         label:{
//             type: String,
//             required: true,
//         },
//     },
//     setup(props) {
//         const page = usePage();
//         const isActive = computed(() => {
//             return props.href === page.props.url || page.url === new URL(props.href,window.location.origin).pathname;
//         });
//         return {
//             isActive,
//         };
//     },
//     template: `<Link
//         :href="href"
//         :class="[
//             'dark:text-blue inline-block px-4 py-2 font-bold text-gray-600 no-underline transition-all duration-10 hover:scale-105 hover:font-bold hover:text-gray-800 mb-2 hover:border-b-4 hover:border-b-orange-700 dark:text-white', isActive ? 'scale-105 font-bold text-gray-800 border-b-4 border-b-orange-700' : 'hover:scale-105 hover:font-bold hover:text-gray-800 hover:border-b-4 hover:border-b-orange-700'
//             ]"
//     >
//     {{ label }}
//     </Link>`
// });

onMounted(() => {
    let scrollpos = window.scrollY;
    let header = document.getElementById('header');
    let navcontent = document.getElementById('nav-content');
    let navaction = document.getElementById('navAction');
    let brandname = document.getElementById('brandname');
    let toToggle = document.querySelectorAll('.toggleColour');
    let toggleButton = document.getElementById('toggleButton');

    document.addEventListener('scroll', function () {
        /*Apply classes for slide in bar*/
        scrollpos = window.scrollY;
        // const savedTheme = localStorage.getItem('theme');
        // if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        //     isDark.value = true;
        //     document.documentElement.classList.add('dark');
        // }
        scrollFunction();
    });

    /*Toggle dropdown list*/
    /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

    let navMenuDiv = document.getElementById('nav-content');
    let navMenu = document.getElementById('nav-toggle');

    document.onclick = check;

    function check(e) {
        const target = (e && e.target) || (event && event.srcElement);

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, navMenu)) {
                // click on the link
                if (navMenuDiv.classList.contains('hidden')) {
                    navMenuDiv.classList.remove('hidden');
                } else {
                    navMenuDiv.classList.add('hidden');
                }
            } else {
                // click both outside link and outside menu, hide menu
                navMenuDiv.classList.add('hidden');
            }
        }
    }

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) {
                return true;
            }
            t = t.parentNode;
        }
        return false;
    }

    /* Dark Mood functionality Starts */
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        isDark.value = true;
        // scrollFunction();
        document.documentElement.classList.add('dark');
    }
    /* Dark Mood functionality Ends */

    /*  Check Scrolling Changes */
    function scrollFunction(e) {
        if (scrollpos > 10) {
            toggleButton.classList.remove('show');
            toggleButton.classList.add('hidden');
            // header = full navbar
            // navaction = action button in navbar
            // toToggle = left panel logo section in navbar
            // navcontent = nevbar menu content section
            if (isDark.value) {
                // Dark Mode
                header.classList.add('bg-white');
                navaction.classList.remove('bg-white');
                // navaction.classList.add("gradient");
                navaction.classList.add('dark:bg-gradient-to-tr', 'dark:from-gray-800', 'dark:to-gray-600');
                navaction.classList.remove('text-gray-800');
                navaction.classList.add('text-white');
                //Use to switch toggleColour colours
                for (var i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add('text-gray-100');
                    toToggle[i].classList.remove('text-white');
                }
                header.classList.add('shadow');
                navcontent.classList.remove('bg-gray-100');
                navcontent.classList.add('bg-white');
            } else {
                // Normal Mode
                header.classList.add('bg-white');
                navaction.classList.remove('bg-white');
                navaction.classList.add('gradient');
                // navaction.classList.add(
                //     "dark:bg-gradient-to-tr",
                //     "dark:from-gray-800",
                //     "dark:to-gray-600"
                // );
                navaction.classList.remove('text-gray-800');
                navaction.classList.add('text-white');
                //Use to switch toggleColour colours
                for (var i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add('text-gray-800');
                    toToggle[i].classList.remove('text-white');
                }
                header.classList.add('shadow');
                navcontent.classList.remove('bg-gray-100');
                navcontent.classList.add('bg-white');
            }
        } else {
            toggleButton.classList.remove('hidden');
            toggleButton.classList.add('show');
            // header = full navbar
            // navaction = action button in navbar
            // toToggle = left panel logo section in navbar
            // navcontent = nevbar menu content section
            if (isDark.value) {
                // Dark Mode
                header.classList.remove('bg-white');
                // navaction.classList.remove("gradient");
                navaction.classList.remove('dark:bg-gradient-to-tr', 'dark:from-gray-800', 'dark:to-gray-600');
                navaction.classList.add('bg-white');
                navaction.classList.remove('text-white');
                navaction.classList.add('text-gray-800');
                //Use to switch toggleColour colours
                for (var i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add('text-white');
                    toToggle[i].classList.remove('text-gray-800');
                }

                header.classList.remove('shadow');
                navcontent.classList.remove('bg-white');
                navcontent.classList.add('bg-gray-100');
            } else {
                // Normal Mode
                header.classList.remove('bg-white');
                navaction.classList.remove('gradient');
                // navaction.classList.remove(
                //     "dark:bg-gradient-to-tr",
                //     "dark:from-gray-800",
                //     "dark:to-gray-600"
                // );
                navaction.classList.add('bg-white');
                navaction.classList.remove('text-white');
                navaction.classList.add('text-gray-800');
                //Use to switch toggleColour colours
                for (var i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add('text-white');
                    toToggle[i].classList.remove('text-gray-800');
                }

                header.classList.remove('shadow');
                navcontent.classList.remove('bg-white'); // for small screens
                navcontent.classList.add('bg-gray-100'); // for small screens
            }
        }
    }
});

/* DarK Mood Toggle */
const toggleDarkMode = () => {
    let navaction = document.getElementById('navAction');
    let toToggle = document.querySelectorAll('.toggleColour');
    isDark.value = !isDark.value;
    if (isDark.value) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        // navaction.classList.remove("gradient");
        navaction.classList.remove('dark:bg-gradient-to-tr', 'dark:from-gray-800', 'dark:to-gray-600');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        // navaction.classList.add("gradient");
        navaction.classList.add('dark:bg-gradient-to-tr', 'dark:from-gray-800', 'dark:to-gray-600');
    }
};
</script>

<template>
    <nav id="header" class="fixed top-0 z-30 w-full text-white dark:bg-black">
        <div class="container mx-auto mt-0 flex w-full flex-wrap items-center justify-between py-2">
            <div class="flex items-center">
                <div class="mr-4 inline fill-current">
                    <img :src="logo" class="mt-0 h-8 md:h-10 lg:h-14" />
                </div>
                <a class="toggleColour text-2xl font-bold text-white no-underline hover:no-underline lg:text-4xl" href="#">
                    <!--Icon from: http://www.potlabicons.com/ -->
                    <!--                        <svg class="inline h-8 fill-current" id="Capa_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 461.727 461.727">-->
                    <!--                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>-->
                    <!--                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>-->
                    <!--                            <g id="SVGRepo_iconCarrier">-->
                    <!--                                <g>-->
                    <!--                                    <g>-->
                    <!--                                        <path style="fill:#aa0e0e;" d="M236.436,6.861L230.868,0L225.3,6.861c-6.576,8.104-160.824,199.02-160.824,288.475 c0,91.739,74.645,166.392,166.384,166.392s166.392-74.653,166.392-166.392C397.26,205.856,242.996,14.957,236.436,6.861z M182.454,395.008l-2.162-1.024c-53.258-25.353-70.987-93.861-54.185-141.949l0.797-2.243l13.542,4.715l-0.788,2.268 c-14.477,41.35,1.187,102.542,46.796,124.286l2.162,1.024L182.454,395.008z"></path>-->
                    <!--                                    </g>-->
                    <!--                                </g>-->
                    <!--                            </g>-->
                    <!--                        </svg>-->
                    BLOOD BANK
                </a>
            </div>
            <div class="block pr-4 lg:hidden">
                <button
                    id="nav-toggle"
                    class="focus:shadow-outline flex transform items-center p-1 text-pink-800 transition duration-300 ease-in-out hover:scale-105 hover:text-gray-900 focus:outline-none dark:text-white"
                >
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div
                class="z-20 mt-2 hidden w-full flex-grow bg-white p-4 text-black lg:mt-0 lg:flex lg:w-auto lg:items-center lg:bg-transparent lg:p-0 dark:max-lg:bg-black"
                id="nav-content"
            >
                <!--                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">-->
                <!--                    -->
                <!--                </ul>-->
                <ul class="list-reset flex-1 items-center justify-end lg:flex list-reset">
                    <li class="mr-3" id="toggleButton">
                        <!-- Toggle Button -->
                        <button @click="toggleDarkMode" class="focus:outline-none cursor-pointer">
                            <!-- Moon Icon (show in light mode) -->
                            <svg
                                v-show="!isDark"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6 text-black"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"
                                />
                            </svg>
                            <!-- Sun Icon (show in dark mode) -->
                            <svg
                                v-show="isDark"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6 text-white"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                />
                            </svg>
                        </button>
                    </li>

<!--                    <li-->
<!--                        v-for="item in sidebarNavItems"-->
<!--                        :key="item.href"-->
<!--                        variant="ghost"-->
<!--                        :class="[ { 'bg-muted': currentPath === item.href }]"-->
<!--                        as-child>-->
<!--                        <Link :href="item.href" class="dark:text-blue inline-block px-4 py-2 font-bold text-gray-600 no-underline transition-all duration-10 hover:scale-105 hover:font-bold hover:text-gray-800 mb-2 hover:border-b-4 hover:border-b-orange-700 dark:text-white">-->
<!--                            {{ item.title }}-->
<!--                        </Link>-->
<!--                    </li>-->
                    <Link
                        :href="route('home')"
                        class="dark:text-blue inline-block px-4 py-2 font-bold text-gray-600 no-underline transition-all duration-10 hover:scale-105 hover:font-bold hover:text-gray-800 mb-2 hover:border-b-4 hover:border-b-orange-700 dark:text-white"
                    >
                        Home
                    </Link>
                    <Link
                        :href="route('about')"
                        class="dark:text-blue inline-block px-4 py-2 font-bold text-gray-600 no-underline transition-all duration-10 hover:scale-105 hover:font-bold hover:text-gray-800 mb-2 hover:border-b-4 hover:border-b-orange-700 dark:text-white"
                        >About
                    </Link>
                    <Link
                        :href="route('contact')"
                        class="dark:text-blue inline-block px-4 py-2 font-bold text-gray-600 no-underline transition-all duration-10 hover:scale-105 hover:font-bold hover:text-gray-800 mb-2 hover:border-b-4 hover:border-b-orange-700 dark:text-white"
                        >Contact
                    </Link>

<!--                    <NavLink href="/" label="Home" />-->
<!--                    <NavLink :href="route('about')" label="About" />-->
<!--                    <NavLink :href="route('register')" label="Register" />-->

                    <!--                    <li class="mr-3">-->
                    <!--                        <a href="#" class="block py-2 px-4 text-gray-800 bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>-->
                    <!--                    </li>-->
                    <!--                    <li class="mr-3">-->
                    <!--                        <a href="#" class="block py-2 px-4 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>-->
                    <!--                    </li>-->
                    <!--                    <li class="mr-3">-->
                    <!--                        <a href="#" class="block py-2 px-4 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>-->
                    <!--                    </li>-->
                    <!--                    <li class="mr-3">-->
                    <!--                        <a href="#" class="block py-2 px-4 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>-->
                    <!--                    </li>-->
                    <!--                    <li class="mr-3">-->
                    <!--                        <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>-->
                    <!--                    </li>-->
                </ul>
                <button
                    id="navAction"
                    class="focus:shadow-outline mx-auto mt-4 transform rounded-full bg-white px-8 py-4 font-bold text-gray-800 opacity-75 shadow transition duration-300 ease-in-out hover:scale-105 hover:underline focus:outline-none lg:mx-0 lg:mt-0"
                >
                    Action
                </button>
            </div>
        </div>
        <hr class="my-0 border-b border-gray-100 py-0 opacity-25" />
    </nav>
</template>

<style scoped></style>
