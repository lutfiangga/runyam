 <section class="py-10 md:pb-8">
     <div class="container max-w-screen-xl mx-auto px-4 xl:relative">
         <div class="border border-blue-800 flex flex-col lg:flex-row items-center justify-evenly px-8 lg:px-auto py-14 rounded-3xl mx-12 relative">
             <div class="lg:text-left mb-10 lg:mb-0 lg:w-1/2 text-justify">
                 <h1 class="text-5xl font-bold leading-tight text-gray-300 sm:text-5xl lg:text-7xl">
                     Kontak
                     <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-blue-800 to-cyan-300">
                         Kami
                     </span>
                 </h1>
                 <p class="max-w-xl mx-auto mt-4 sm:mr-24 text-base leading-relaxed text-gray-600">
                     Punya Kritik dan Saran? <br /> Kritik dan saran anda membantu kami
                     dalam proses pengembangan.
                 </p>
             </div>

             <div class="hidden xl:block xl:absolute right-0">
                 <svg width="700" height="700" viewBox="-50 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <circle cx="250" cy="250" r="40" stroke="#1e40af" stroke-width="2" />
                     <circle cx="250" cy="250" r="80" stroke="#1e40af" stroke-width="2" />
                     <circle cx="250" cy="250" r="120" stroke="#1e40af" stroke-width="2" />
                     <circle cx="250" cy="250" r="160" stroke="#1e40af" stroke-width="2" />
                     <circle cx="250" cy="250" r="200" stroke="#1e40af" stroke-width="2" />
                     <circle cx="250" cy="250" r="240" stroke="#1e40af" stroke-width="2" />
                 </svg>
             </div>

             <div class="md:block border border-blue-800 bg-gray-900 xl:relative px-4 py-3 rounded-3xl">
                 <form method="POST" action="<?= site_url('Index/aduan') ?>" enctype="multipart/form-data">
                     <div class="py-2 hidden">
                         <input type="text" name="status" value="pending" class="px-4 py-4 w-full md:w-96 border border-blue-800 bg-gray-900 placeholder-gray-600 text-gray-300 rounded-xl outline-none" autocomplete="off" required />
                         <input type="text" name="waktu_aduan" value="<?= date('Y/m/d H:i:s') ?>" class="px-4 py-4 w-full md:w-96 border border-blue-800 bg-gray-900 placeholder-gray-600 text-gray-300 rounded-xl outline-none" autocomplete="off" required />
                     </div>
                     <div class="py-2">
                         <input type="text" placeholder="Nama" name="pengirim" class="px-4 py-4 w-full md:w-96 border border-blue-800 bg-gray-900 placeholder-gray-600 text-gray-300 rounded-xl outline-none" autocomplete="off" required />
                     </div>
                     <div class="py-2">
                         <input type="text" placeholder="Subjek" name="subjek" class="px-4 py-4 w-full md:w-96 border border-blue-800 bg-gray-900 placeholder-gray-600 text-gray-300 rounded-xl outline-none" autocomplete="off" required />
                     </div>
                     <div class="py-2">
                         <textarea type="text" placeholder="Pesan" name="pesan" class="px-4 py-4 w-full md:w-96 border border-blue-800 bg-gray-900 placeholder-gray-600 text-gray-300 rounded-xl outline-none" rows="3" autocomplete="off" required></textarea>
                     </div>
                     <div class="py-2">
                         <button type="submit" class="w-full py-4 font-semibold text-lg text-white bg-sky-600 rounded-xl hover:bg-blue-800 transition ease-in-out duration-500">
                             Kirim
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </section>