{{-- Bottom Menu --}}
@php
    $path = explode('/', Request::path());
@endphp

<div class="flex justify-center">
    <div id="menu-user"
        class="fixed bottom-3 flex items-center justify-between w-[344px] gap-2 rounded-3xl p-2 bg-[#E9EFEC] shadow-lg">
        <a href="{{ route('dashboard-user') }}"
            class="grid w-[76px] text-center {{ request()->routeIs('dashboard-user') ? 'user-active' : '' }}">
            <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                <iconify-icon icon="ic:outline-home"
                    class="menu-icon text-[24px] {{ request()->routeIs('dashboard-user') ? 'text-white' : '' }}"></iconify-icon>
            </div>
            <div class="{{ request()->routeIs('dashboard-user') ? 'font-bold' : '' }} text-[10px] mt-1">Home</div>
        </a>
        <a href="{{ route('donasi-campaign-user') }}" id="menu-user"
            class="grid w-[76px] text-center {{ request()->routeIs('donasi-campaign-user') ? 'user-active' : '' }}">
            <div class="">
                <div class="py-1 rounded-2xl flex items-center  justify-center item-user">
                    <iconify-icon icon="mdi:donation"
                        class="text-[24px] menu-icon {{ request()->routeIs('donasi-campaign-user') ? 'text-white' : '' }}"></iconify-icon>
                </div>
                <div class="{{ request()->routeIs('donasi-campaign-user') ? 'font-bold' : '' }} text-[10px] mt-1">Donasi
                </div>
            </div>
        </a>
        <a href="{{ route('kegiatan') }}" id="menu-user"
            class="grid w-[76px] text-center {{ request()->routeIs('kegiatan') ? 'user-active' : '' }}">
            <div class="">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="mdi:newspaper"
                        class="menu-icon text-[24px] {{ request()->routeIs('kegiatan') ? 'text-white' : '' }}"></iconify-icon>
                </div>
                <div class="{{ request()->routeIs('kegiatan') ? 'font-bold' : '' }} text-[10px] mt-1">Kegiatan</div>
            </div>
        </a>
        <a href="{{ route('about') }}" id="menu-user"
            class="grid w-[76px] text-center {{ request()->routeIs('about') ? 'user-active' : '' }}">
            <div class="">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="ix:about"
                        class="menu-icon text-[24px] {{ request()->routeIs('about') ? 'text-white' : '' }}"></iconify-icon>
                </div>
                <div class="{{ request()->routeIs('about') ? 'font-bold' : '' }} text-[10px] mt-1">About</div>
            </div>
        </a>
        {{-- <a href="{{ route('user.umkm') }}" id="menu-user" class="grid w-[76px] text-center">
            <div class="{{ in_array('umkm', $path) ? 'user-active' : '' }}">
                <div class="py-1 rounded-2xl flex items-center justify-center item-user">
                    <iconify-icon icon="material-symbols:shopping-bag-outline"
                        class="text-[24px] {{ in_array('umkm', $path) ? '' : 'text-[#3F4945]' }}"></iconify-icon>
                </div>
                <div class="{{ in_array('umkm', $path) ? '' : 'text-[#3F4945]' }} text-[10px] mt-1">UMKM</div>
            </div>
        </a> --}}
    </div>
</div>
