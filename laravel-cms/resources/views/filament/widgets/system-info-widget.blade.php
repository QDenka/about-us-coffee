<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Thông tin hệ thống
        </x-slot>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hoạt động gần đây</h3>
                
                <div class="space-y-3">
                    @foreach($this->getSystemInfo()['recent_contacts'] as $contact)
                        <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-sm">{{ $contact->name }}</span>
                                <span class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $contact->email }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Stats -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Thông tin hệ thống</h3>
                
                <div class="grid grid-cols-1 gap-3">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Laravel</span>
                            <span class="text-sm text-blue-600 dark:text-blue-400">{{ $this->getSystemInfo()['laravel_version'] }}</span>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-green-700 dark:text-green-300">PHP</span>
                            <span class="text-sm text-green-600 dark:text-green-400">{{ $this->getSystemInfo()['php_version'] }}</span>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-purple-700 dark:text-purple-300">Cơ sở dữ liệu</span>
                            <span class="text-sm text-purple-600 dark:text-purple-400">{{ $this->getSystemInfo()['database_size'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="/admin/stories" class="flex items-center justify-center p-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:from-blue-600 hover:to-purple-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Câu chuyện
                </a>
                
                <a href="/admin/events" class="flex items-center justify-center p-3 bg-gradient-to-r from-green-500 to-teal-600 text-white rounded-lg hover:from-green-600 hover:to-teal-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Sự kiện
                </a>
                
                <a href="/admin/gallery-images" class="flex items-center justify-center p-3 bg-gradient-to-r from-pink-500 to-rose-600 text-white rounded-lg hover:from-pink-600 hover:to-rose-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Thư viện ảnh
                </a>
                
                <a href="/admin/contact-submissions" class="flex items-center justify-center p-3 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-lg hover:from-yellow-600 hover:to-orange-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Liên hệ
                </a>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>