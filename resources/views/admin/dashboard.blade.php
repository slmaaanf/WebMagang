@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
    <!-- Konten Utama -->
    <div class="flex-grow max-w-6xl mx-auto mt-8 px-4">
        <!-- Judul Dashboard -->
        <h2 class="text-blue-600 font-bold text-2xl text-center mb-3">Admin Dashboard</h2>
        <p class="text-center text-gray-500">Selamat datang, Nama Admin!</p>

        <!-- Kartu Informasi -->
        <div class="flex flex-wrap gap-4 mt-6 justify-between items-center">
            <!-- User -->
            <div class="flex-1 min-w-[200px] bg-white shadow-md p-4 rounded-lg text-center">
                <h5 class="text-gray-500">User</h5>
                <h3 class="text-blue-600 font-bold text-xl">{{ $jumlahPendaftar }} Users</h3>
                <i class="bi bi-people text-blue-600 text-2xl"></i>
            </div>

            <!-- Pembimbing -->
            <div class="flex-1 min-w-[200px] bg-white shadow-md p-4 rounded-lg text-center">
                <h5 class="text-gray-500">Pembimbing</h5>
                <h3 class="text-green-600 font-bold text-xl">{{ $jumlahPembimbing }} Pembimbing</h3>
                <i class="bi bi-person-badge text-green-600 text-2xl"></i>
            </div>

            <!-- Program Magang -->
            <div class="flex-1 min-w-[200px] bg-white shadow-md p-4 rounded-lg text-center">
                <h5 class="text-gray-500">Program Magang</h5>
                <h3 class="text-purple-600 font-bold text-xl">{{ $jumlahProgram }} Program</h3>
                <i class="bi bi-briefcase text-purple-600 text-2xl"></i>
            </div>
        </div>

        <!-- Daftar Program Magang -->
        <div class="bg-white shadow-md rounded-lg mt-6">
            <div class="bg-blue-600 text-white font-bold px-4 py-2 rounded-t-lg flex justify-between items-center">
                <span>Daftar Program Magang</span>
            </div>
            <div class="px-4 py-2 flex justify-end">
                <a href="{{ route('admin.internships.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                    ➕ Tambah Program Magang
                </a>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg">
                    <thead class="bg-[#679CEB] text-white">
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Deskripsi</th>
                            <th class="px-4 py-2 border">Lokasi</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($internships as $internship)
                        <tr class="text-center bg-gray-100">
                            <td class="px-4 py-2 border">{{ $internship->name }}</td>
                            <td class="px-4 py-2 border">{{ $internship->description }}</td>
                            <td class="px-4 py-2 border">{{ $internship->location }}</td>
                            <td class="px-4 py-2 border flex justify-center gap-2">
                                <a href="{{ route('internships.show', $internship->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-eye mr-1"></i> Lihat
                                </a>
                                <a href="{{ route('admin.internships.edit', $internship->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-pencil mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.internships.destroy', $internship->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                        <i class="bi bi-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daftar Pembimbing -->
        <div class="bg-white shadow-md rounded-lg mt-6">
            <div class="bg-blue-600 text-white font-bold px-4 py-2 rounded-t-lg">
                Daftar Pembimbing
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg">
                    <thead class="bg-[#679CEB] text-white">
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">No. Telepon</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentors as $mentor)
                        <tr class="text-center bg-gray-100">
                            <td class="px-4 py-2 border">{{ $mentor->name }}</td>
                            <td class="px-4 py-2 border">{{ $mentor->email }}</td>
                            <td class="px-4 py-2 border">{{ $mentor->phone }}</td>
                            <td class="px-4 py-2 border flex justify-center gap-2">
                                <a href="{{ route('admin.users.show', $mentor->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-eye mr-1"></i> Lihat
                                </a>

                                <a href="{{ route('admin.users.edit', $mentor->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-pencil mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $mentor->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembimbing ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                        <i class="bi bi-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daftar User -->
        <div class="bg-white shadow-md rounded-lg mt-6">
            <div class="bg-blue-600 text-white font-bold px-4 py-2 rounded-t-lg">
                Daftar User
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg">
                    <thead class="bg-[#679CEB] text-white">
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">No. Telepon</th>
                            <th class="px-4 py-2 border">Instansi</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="text-center bg-gray-100">
                            <!-- Nama dan Email dalam satu kolom -->
                            <td>
                                <div>
                                    <span class="font-semibold">{{ $user->name }}</span>
                                </div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-4 py-2 border">{{ $user->phone }}</td>
                            <td class="px-4 py-2 border">{{ $user->institution }}</td>
                            <td class="px-4 py-2 border flex justify-center gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-eye mr-1"></i> Lihat
                                </a>

                                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded flex items-center">
                                    <i class="bi bi-pencil mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded flex items-center">
                                        <i class="bi bi-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6 text-center">
        <p class="font-inter">Jalan Mesjid No. 1 Kota Sukabumi 43111, Sukabumi, West Java</p>
        <p class="font-inter">📞 +85253000843 | 📧 @TelkomIndonesia | 🌐 @plasatelkomsukabumi</p>
    </footer>
</div>
@endsection
