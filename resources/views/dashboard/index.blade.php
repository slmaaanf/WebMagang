@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="relative">
    <div class="slideshow-container h-[300px] relative overflow-hidden">
        <!-- Slide 1 -->
        <div class="slides bg-cover bg-center active" style="background-image: url('{{ asset('banner1.png') }}');">
            <div class="absolute inset-0 bg-[#5E7CC7]/70 flex items-center">
                <div class="container mx-auto text-white px-6">
                    <h1 class="text-6xl font-bold font-poppins text-[#FBFF00]">
                        Intern, Innovate, Inspire
                    </h1>
                    <p class="mt-4 text-lg font-inter">Segera daftarkan dirimu untuk mendapatkan kesempatan</p>
                    <a href="{{ route('contact') }}"
                        class="mt-6 inline-block bg-[#FBFF00] hover:bg-yellow-400 text-blue-900 px-6 py-3 rounded-full font-semibold shadow-lg transition duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slides bg-cover bg-center" style="background-image: url('{{ asset('banner2.png') }}');">
            <div class="absolute inset-0 bg-[#679CEB]/70 flex items-center">
                <div class="container mx-auto text-white px-6">
                    <h1 class="text-6xl font-bold font-poppins text-[#FFD700]">
                        Kembangkan Potensimu
                    </h1>
                    <p class="mt-4 text-lg font-inter">Dapatkan pengalaman kerja nyata di dunia industri</p>
                    <a href="#program"
                        class="mt-6 inline-block bg-white hover:bg-gray-200 text-blue-700 px-6 py-3 rounded-full font-semibold shadow-lg transition duration-300">
                        Pelajari Program
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slides bg-cover bg-center" style="background-image: url('{{ asset('banner3.png') }}');">
            <div class="absolute inset-0 bg-[#8236CB]/70 flex items-center">
                <div class="container mx-auto text-white px-6">
                    <h1 class="text-6xl font-bold font-poppins text-[#FFD700]">
                        Mulai Perjalananmu
                    </h1>
                    <p class="mt-4 text-lg font-inter">Daftar sekarang dan raih sertifikat profesional</p>
                    <a href="{{ route('register') }}"
                        class="mt-6 inline-block bg-[#FFD700] hover:bg-yellow-400 text-blue-900 px-6 py-3 rounded-full font-semibold shadow-lg transition duration-300">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation buttons -->
    <a class="prev absolute left-5 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-4 py-2 rounded-lg cursor-pointer z-10"
       onclick="changeSlide(-1)">&#10094;</a>
    <a class="next absolute right-5 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-4 py-2 rounded-lg cursor-pointer z-10"
       onclick="changeSlide(1)">&#10095;</a>
</div>

<!-- Section Fitur -->
<div class="container mx-auto py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Tentang Program -->
        <div class="bg-[#E8E8E8] shadow-md p-6 rounded-lg">
            <h3 class="text-lg font-bold text-purple-600 font-poppins">Tentang Program</h3>
            <p class="text-gray-600 mt-2 font-inter">
                Program ini dirancang untuk memberikan <span class="text-blue-500 font-semibold">pengalaman</span> kepada mahasiswa
                atau siswa dalam dunia industri.
            </p>
        </div>

        <!-- Fitur Utama -->
        <div class="bg-[#E8E8E8] shadow-md p-6 rounded-lg">
            <h3 class="text-lg font-bold text-purple-600 font-poppins">Fitur Utama</h3>
            <ul class="text-gray-600 mt-2 font-inter">
                <li><span class="font-semibold text-blue-600">✔️ Manajemen Tugas:</span> Mengelola tugas harian lebih efisien.</li>
                <li><span class="font-semibold text-blue-600">✔️ Pelaporan Kinerja:</span> Melihat dan melaporkan progres magang.</li>
                <li><span class="font-semibold text-blue-600">✔️ Notifikasi Otomatis:</span> Pengingat otomatis untuk tugas.</li>
            </ul>
        </div>

        <!-- Kesempatan Mengikuti Program -->
        <div class="bg-[#E8E8E8] shadow-md p-6 rounded-lg">
            <h3 class="text-lg font-bold text-purple-600 font-poppins">Kesempatan Mengikuti Program</h3>
            <ul class="text-gray-600 mt-2 font-inter">
                <li><span class="font-semibold text-blue-600">✔️</span> Pengalaman kerja nyata</li>
                <li><span class="font-semibold text-blue-600">✔️</span> Meningkatkan soft skills dan teknis</li>
                <li><span class="font-semibold text-blue-600">✔️</span> Sertifikat untuk meningkatkan CV</li>
            </ul>
        </div>
    </div>
    <!-- Section Tentang Kami -->
<div class="container mx-auto py-16" data-aos="fade-up">
    <div class="bg-[#F3F4F6] shadow-md p-8 rounded-lg">
        <h2 class="text-3xl font-bold text-purple-600 font-poppins text-center">Tentang Kami</h2>
        <p class="text-gray-600 mt-4 font-inter text-center">
            Kami adalah tim pengembang web yang berdedikasi untuk menciptakan solusi digital inovatif dan mendukung transformasi digital
            di berbagai industri. Kami berkomitmen untuk memberikan layanan terbaik dan menghadirkan pengalaman pengguna yang luar biasa.
        </p>
        
        <!-- Team Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
            <!-- Anggota 1 -->
            <div class="text-center" data-aos="fade-up">
                <div class="relative overflow-hidden rounded-lg w-40 h-48 mx-auto bg-gray-100">
                    <img src="{{ asset('team/front_end.jpg') }}" alt="Putra Satria Nagara M." class="object-cover w-full h-full">
                </div>
                <h3 class="mt-4 text-xl font-bold text-blue-600 font-poppins">Putra Satria Nagara M.</h3>
                <p class="text-gray-600 mt-2 font-inter">Front End Developer</p>
            </div>

            <!-- Anggota 2 -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden rounded-lg w-40 h-48 mx-auto bg-gray-100">
                    <img src="{{ asset('team/ui_ux.jpg') }}" alt="Viona Mojang Pamungkas" class="object-cover w-full h-full">
                </div>
                <h3 class="mt-4 text-xl font-bold text-blue-600 font-poppins">Viona Mojang Pamungkas</h3>
                <p class="text-gray-600 mt-2 font-inter">UI/UX Designer</p>
            </div>

            <!-- Anggota 3 -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="relative overflow-hidden rounded-lg w-40 h-48 mx-auto bg-gray-100">
                    <img src="{{ asset('team/back_end.jpg') }}" alt="Jasmine Nayla Hafiezh" class="object-cover w-full h-full">
                </div>
                <h3 class="mt-4 text-xl font-bold text-blue-600 font-poppins">Jasmine Nayla Hafiezh</h3>
                <p class="text-gray-600 mt-2 font-inter">Back End Developer</p>
            </div>
        </div>
    </div>
</div>

<!-- Floating Chatbot Button -->
<div id="chatbot-button" class="fixed bottom-6 right-6 z-50">
    <button onclick="toggleChatbot()"
        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full shadow-lg font-semibold transition duration-300">
        💬 Chat dengan Kami
    </button>
</div>

<!-- Chatbot Modal -->
<div id="chatbot-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="relative w-80 h-[430px] mx-auto mt-20 bg-white rounded-lg shadow-lg">
        <button onclick="toggleChatbot()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✖</button>
        <iframe height="430" width="100%" src="https://bot.dialogflow.com/9a77a1bb-bdf9-4a9a-bc29-9db600342efd" frameborder="0"></iframe>
        <div id="iframe-error" class="hidden text-center text-red-600 mt-4">Gagal memuat chatbot. Silakan coba lagi nanti.</div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-[#679CEB] text-white py-8">
    <div class="container mx-auto text-center">
        <p class="font-inter">Jalan Mesjid No. 1 Kota Sukabumi 43111, Sukabumi, West Java</p>
        <p class="font-inter">📞 +85253000843 | 📧 @TelkomIndonesia | 🌐 @plasatelkomsukabumi</p>
    </div>
</footer>

<!-- CSS tambahan -->
<style>
    .slideshow-container {
        position: relative;
        overflow: hidden;
    }

    .slides {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 100%;
        opacity: 0;
        transform: translateX(100%);
        transition: transform 0.8s ease-in-out, opacity 0.8s ease-in-out;
    }

    .slides.active {
        left: 0;
        transform: translateX(0%);
        opacity: 1;
        z-index: 1;
    }

    #chatbot-modal.hidden {
        display: none;
    }
</style>

<!-- JavaScript -->
<script>
    let slideIndex = 0;
    const slides = document.querySelectorAll('.slides');

    function showSlide(n) {
        slides.forEach((slide, index) => {
            slide.classList.remove('active');
        });
        slides[n].classList.add('active');
    }

    function changeSlide(n) {
        slideIndex = (slideIndex + n + slides.length) % slides.length;
        showSlide(slideIndex);
    }

    setInterval(() => changeSlide(1), 5000);

    document.addEventListener('DOMContentLoaded', () => {
        showSlide(slideIndex);
    });

    function toggleChatbot() {
        const modal = document.getElementById('chatbot-modal');
        modal.classList.toggle('hidden');
    }
</script>

@endsection