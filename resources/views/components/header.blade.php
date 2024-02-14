 <header>
     <nav class="absolute z-10 w-full border-b border-black/5 dark:border-white/5 lg:border-transparent">
         <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
             <div class="relative flex flex-wrap items-center justify-between gap-6 py-3 md:gap-0 md:py-4">
                 <div class="relative z-20 flex w-full justify-between md:px-0 lg:w-max">
                     <a href="/#home" aria-label="logo" class="flex items-center space-x-2">
                         <div aria-hidden="true" class="flex space-x-1">
                             <div class="h-4 w-4 rounded-full bg-gray-900 dark:bg-white"></div>
                             <div class="h-6 w-2 bg-rose-500"></div>
                         </div>
                         <span class="text-2xl font-bold text-gray-900 dark:text-white">Dwin</span>
                     </a>

                     <div class="relative flex max-h-10 items-center md:hidden">
                         <button aria-label="humburger" id="hamburger" class="relative -mr-6 p-6">
                             <div aria-hidden="true" id="line"
                                 class="m-auto h-0.5 w-5 rounded bg-sky-900 transition duration-300 dark:bg-gray-300">
                             </div>
                             <div aria-hidden="true" id="line2"
                                 class="m-auto mt-2 h-0.5 w-5 rounded bg-sky-900 transition duration-300 dark:bg-gray-300">
                             </div>
                         </button>
                     </div>
                 </div>
                 <div id="navLayer" aria-hidden="true"
                     class="fixed inset-0 z-10 h-screen w-screen origin-bottom scale-y-0 bg-white/70 backdrop-blur-2xl transition duration-500 dark:bg-gray-900/70 lg:hidden">
                 </div>
                 <div id="navlinks"
                     class="invisible absolute top-full left-0 z-20 origin-top-right translate-y-1 scale-90 flex-col flex-wrap justify-end gap-6 rounded-3xl border border-gray-100 bg-white p-8 opacity-0 shadow-2xl shadow-gray-600/10 transition-all duration-300 dark:border-gray-700  dark:shadow-none lg:visible lg:relative lg:flex lg:w-7/12 lg:translate-y-0 lg:scale-100 lg:flex-row lg:items-center lg:gap-0 lg:border-none lg:bg-transparent lg:p-0 lg:opacity-100 lg:shadow-none">
                     <div class="text-gray-600 dark:text-gray-200 lg:w-auto lg:pr-4 lg:pt-0">
                         <ul class="flex flex-col gap-6 tracking-wide lg:flex-row lg:gap-0 lg:text-sm">
                             <li>
                                 <a href="/#features"
                                     class="hover:text-rose-500 block transition dark:hover:text-white md:px-4">
                                     <span>About</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="/#solution"
                                     class="hover:text-rose-500 block transition dark:hover:text-white md:px-4">
                                     <span>Our Covers</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="/#reviews"
                                     class="hover:text-rose-500 block transition dark:hover:text-white md:px-4">
                                     <span>Client Services</span>
                                 </a>
                             </li>

                         </ul>
                     </div>

                     <div class="mt-12 lg:mt-0">
                         <a href="/register"
                             class="relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-full before:bg-rose-500 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                             <span class="relative text-sm font-semibold text-white">Get Qoute</span>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </nav>
 </header>
