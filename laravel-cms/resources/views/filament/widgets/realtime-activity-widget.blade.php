<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                Hoạt động thời gian thực
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            </div>
        </x-slot>

        <div class="space-y-4">
            <!-- Hourly Stats -->
            <div class="grid grid-cols-3 gap-3">
                <div class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="text-xl font-bold text-blue-600">{{ $this->getRealtimeData()['hourly_stats']['views'] }}</div>
                    <div class="text-xs text-blue-500">Lượt xem/giờ</div>
                </div>

                <div class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <div class="text-xl font-bold text-green-600">{{ $this->getRealtimeData()['hourly_stats']['unique_visitors'] }}</div>
                    <div class="text-xs text-green-500">Khách truy cập</div>
                </div>

                <div class="text-center p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <div class="text-xl font-bold text-purple-600">{{ $this->getRealtimeData()['hourly_stats']['new_contacts'] }}</div>
                    <div class="text-xs text-purple-500">Liên hệ</div>
                </div>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
