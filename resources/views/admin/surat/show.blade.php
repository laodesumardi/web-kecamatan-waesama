@extends('layouts.main')

@section('title', 'Detail Surat - ' . $surat->nomor_surat)

@section('sidebar-menu')
    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-tachometer-alt"></i>
        <span class="nav-text">Dashboard</span>
    </a>
    
    <!-- Data Penduduk -->
    <a href="{{ route('admin.penduduk.index') }}" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-users"></i>
        <span class="nav-text">Data Penduduk</span>
    </a>
    
    <!-- Layanan Surat -->
    <a href="{{ route('admin.surat.index') }}" class="nav-item active text-white">
        <i class="fas fa-file-alt"></i>
        <span class="nav-text">Layanan Surat</span>
    </a>
    
    <!-- Antrian -->
    <a href="#" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-clock"></i>
        <span class="nav-text">Antrian</span>
    </a>
    
    <!-- Berita -->
    <a href="{{ route('admin.berita.index') }}" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-newspaper"></i>
        <span class="nav-text">Berita</span>
    </a>
    
    <!-- Pengaduan -->
    <a href="#" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-comments"></i>
        <span class="nav-text">Pengaduan</span>
    </a>
    
    <!-- Manajemen User -->
    <a href="#" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-user-cog"></i>
        <span class="nav-text">Manajemen User</span>
    </a>
    
    <!-- Laporan -->
    <a href="#" class="nav-item text-gray-700 hover:text-white">
        <i class="fas fa-chart-bar"></i>
        <span class="nav-text">Laporan</span>
    </a>
@endsection

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.surat.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Surat</h1>
                    <p class="text-gray-600">{{ $surat->nomor_surat }}</p>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3">
                @if($surat->status !== 'Selesai')
                    <a href="{{ route('admin.surat.edit', $surat) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                @endif
                
                @if($surat->status === 'Selesai')
                    <a href="{{ route('admin.surat.download', $surat) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-download mr-2"></i>Download
                    </a>
                @endif
                
                <form action="{{ route('admin.surat.destroy', $surat) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Informasi Surat -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Surat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Surat</label>
                            <p class="text-gray-900 font-medium">{{ $surat->nomor_surat }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Surat</label>
                            <p class="text-gray-900">{{ $surat->jenis_surat }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Pengajuan</label>
                            <p class="text-gray-900">{{ $surat->created_at->format('d F Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($surat->status === 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($surat->status === 'Diproses') bg-blue-100 text-blue-800
                                @elseif($surat->status === 'Selesai') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $surat->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Data Pemohon -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Data Pemohon</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $surat->nama_pemohon }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">NIK</label>
                            <p class="text-gray-900">{{ $surat->nik_pemohon }}</p>
                        </div>
                        @if($surat->phone_pemohon)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Telepon</label>
                            <p class="text-gray-900">{{ $surat->phone_pemohon }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                        <p class="text-gray-900">{{ $surat->alamat_pemohon }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Keperluan -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Keperluan</h3>
                    <p class="text-gray-900 leading-relaxed">{{ $surat->keperluan }}</p>
                </div>
            </div>
            
            @if($surat->catatan)
            <!-- Catatan -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Catatan</h3>
                    <p class="text-gray-900 leading-relaxed">{{ $surat->catatan }}</p>
                </div>
            </div>
            @endif
            
            @if($surat->data_tambahan && is_array($surat->data_tambahan))
            <!-- Data Tambahan -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Data Tambahan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($surat->data_tambahan as $key => $value)
                            @if($value)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                <p class="text-gray-900">{{ $value }}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Status Card -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Surat</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full {{ $surat->status === 'Pending' ? 'bg-yellow-500' : 'bg-gray-300' }} mr-3"></div>
                            <span class="text-sm {{ $surat->status === 'Pending' ? 'font-medium text-gray-900' : 'text-gray-500' }}">Pending</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full {{ $surat->status === 'Diproses' ? 'bg-blue-500' : 'bg-gray-300' }} mr-3"></div>
                            <span class="text-sm {{ $surat->status === 'Diproses' ? 'font-medium text-gray-900' : 'text-gray-500' }}">Diproses</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full {{ $surat->status === 'Selesai' ? 'bg-green-500' : 'bg-gray-300' }} mr-3"></div>
                            <span class="text-sm {{ $surat->status === 'Selesai' ? 'font-medium text-gray-900' : 'text-gray-500' }}">Selesai</span>
                        </div>
                    </div>
                    
                    @if($surat->status !== 'Selesai' && $surat->status !== 'Ditolak')
                    <div class="mt-6 space-y-2">
                        @if($surat->status === 'Pending')
                        <form action="{{ route('admin.surat.process', $surat) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                <i class="fas fa-play mr-2"></i>Proses Surat
                            </button>
                        </form>
                        @endif
                        
                        @if($surat->status === 'Diproses')
                        <form action="{{ route('admin.surat.complete', $surat) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                                <i class="fas fa-check mr-2"></i>Selesaikan
                            </button>
                        </form>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- System Info -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Sistem</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Dibuat</label>
                            <p class="text-sm text-gray-900">{{ $surat->created_at->format('d F Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Terakhir Diupdate</label>
                            <p class="text-sm text-gray-900">{{ $surat->updated_at->format('d F Y H:i') }}</p>
                        </div>
                        @if($surat->tanggal_selesai)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Selesai</label>
                            <p class="text-sm text-gray-900">{{ $surat->tanggal_selesai->format('d F Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="space-y-2">
                        @if($surat->status !== 'Selesai')
                        <a href="{{ route('admin.surat.edit', $surat) }}" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm text-center block">
                            <i class="fas fa-edit mr-2"></i>Edit Surat
                        </a>
                        @endif
                        
                        @if($surat->status === 'Selesai')
                        <a href="{{ route('admin.surat.download', $surat) }}" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm text-center block">
                            <i class="fas fa-download mr-2"></i>Download PDF
                        </a>
                        @endif
                        
                        <button onclick="window.print()" class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors text-sm">
                            <i class="fas fa-print mr-2"></i>Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection