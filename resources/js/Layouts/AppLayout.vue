<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="flex flex-col h-screen bg-gray-50 dark:border-gray-600 dark:bg-slate-800"> <!--h-screen--> 
            <nav class="sticky top-0 z-50 bg-gray-200 border-b border-gray-100 dark:border-gray-600 dark:bg-slate-900">
                <!-- Primary Navigation Menu max-w-7xl -->
                <div class="mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-12">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center mr-16">
                                <Link :href="route('users')">
                                    <jet-application-mark class="block h-9 w-auto" />
                                </Link>
                            </div>

                            <div v-if="$can('home.index')" class="hidden space-x-2 sm:-my-px sm:ml-1 sm:flex ml-2">
                                <jet-nav-link class="pl-4 pr-10" :href="route('dashboard')" :active="route().current('dashboard')">
                                <svg class="mx-2 h-5 w-5" fill= "none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>   
                                      {{__('dashboard_section_title')}}
                                </jet-nav-link>
                            </div>

                            <div v-if="$can('users_editor.index')" class="hidden space-x-2 sm:-my-px sm:ml-1 sm:flex ml-2">
                                <jet-nav-link class="pl-4 pr-10" :href="route('users')" 
                                :active="route().current('users') || route().current('users.*') ||
                                        route().current('roles_permissions') || route().current('roles_permissions.*')  || 
                                        route().current('permissions_asignation') || route().current('permissions_asignation.*') ">
                                    <svg class="mx-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                     {{__('user_section_title')}}
                                </jet-nav-link>
                            </div>

                            <!--  <div v-if="$can('bodega.index')" class="hidden space-x-2 sm:-my-px sm:ml-1 sm:flex ml-2">
                                <jet-nav-link class="pl-4 pr-10" :href="route('bodega')" :active="route().current('bodega')">
                                <svg class="mx-2 h-5 w-5" fill= "none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>   
                                      {{__('bodega_title')}}
                                </jet-nav-link>
                            </div> -->
                            
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <jet-dropdown-link :href="route('teams.show', $page.props.user.current_team)">
                                                    Team Settings
                                                </jet-dropdown-link>

                                                <jet-dropdown-link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                                    Create New Team
                                                </jet-dropdown-link>

                                                <div class="border-t border-gray-100 dark:border-gray-600"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <jet-dropdown-link as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </jet-dropdown-link>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </jet-dropdown>

                                <Darkmode/>

                            </div>
                            
                            
                            
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>
                                        
                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-300 focus:outline-none dark:border-gray-600 dark:bg-gray-800 dark:text-white transition">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                     
                                        <jet-dropdown-link :href="route('profile.show')">
                                             {{__('jets_menu_profile')}} 
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures && $can('api_tokens.index')">
                                             {{__('jets_menu_api')}} 
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100 dark:border-gray-600"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                {{__('jets_menu_logout')}} 
                                            </jet-dropdown-link>
                                        </form>

                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none  focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-1 pb-1 space-y-1">
                        <jet-responsive-nav-link v-if="$can('home.index')" :href="route('dashboard')" :active="route().current('dashboard')">
                             {{__('dashboard_section_title')}}
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link  v-if="$can('users_editor.index')" :href="route('users')" :active="route().current('users') || route().current('users.*') ||
                                        route().current('roles_permissions') || route().current('roles_permissions.*')  || 
                                        route().current('permissions_asignation') || route().current('permissions_asignation.*')">
                            {{__('user_section_title')}}
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link  v-if="$can('bodega.index')" :href="route('bodega')" :active="route().current('bodega') || route().current('bodega.*')">
                            {{__('bodega_title')}}
                        </jet-responsive-nav-link>

                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-1 pb-1 border-t border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                      
                        <div class="mt-1 space-y-1">
                            <Darkmode/>
                            <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                 {{__('jets_menu_profile')}}   
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link  :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures && $can('api_tokens.index')">
                                {{__('jets_menu_api')}} 
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                   {{__('jets_menu_logout')}} 
                                </jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <jet-responsive-nav-link :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">
                                    Team Settings
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link :href="route('teams.create')" :active="route().current('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                    Create New Team
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                    <form @submit.prevent="switchToTeam(team)">
                                        <jet-responsive-nav-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.props.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-responsive-nav-link>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow dark:border-gray-600 dark:bg-slate-800 dark:text-white" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>
            
            <!-- Page Content -->
            <!-- <main class="mb-auto relative">-->
            <main class="mb-auto relative bg-gray-50   dark:bg-slate-800">
                <slot></slot>
            </main>
                            
            <Footer></Footer>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import Footer from './Footer.vue'
    import Darkmode from 'Shared/Darkmode.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
       
    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,Footer,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,Darkmode
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('log_out'));
            },
        }
    })
</script>
