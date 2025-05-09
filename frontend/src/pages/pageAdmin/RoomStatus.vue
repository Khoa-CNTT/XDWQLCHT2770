<template>
    <div class="p-6">
      <h2 class="text-2xl font-bold mb-4">Tình trạng phòng</h2>
      <div class="mb-4 flex items-center">
        <div class="mr-4">
          <label class="mr-2">Chọn homestay:</label>
          <select v-model="selectedHomestay" @change="fetchRoomStatus" class="border rounded px-2 py-1">
            <option v-for="homestay in homestays" :key="homestay.id" :value="homestay.id">
              {{ homestay.ten_homestay }}
            </option>
          </select>
        </div>
        <div>
          <label class="mr-2">Chọn ngày:</label>
          <input v-model="selectedDate" type="date" class="border rounded px-2 py-1" @change="fetchRoomStatus" />
        </div>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <div v-for="room in rooms" :key="room.id" :class="getStatusClass(room.status)" class="border p-4 rounded-lg relative">
          <h3 class="font-semibold">{{ room.ten_phong }}</h3>
          <span class="absolute top-2 right-2 text-xs" :class="room.tinh_trang == 1 ? 'text-green-500' : 'text-red-500'">
            {{ room.display_tinh_trang }}
          </span>
          <p class="text-sm">{{ getStatusText(room.status) }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
//   import { ref, onMounted } from 'vue';
  import axios from 'axios';
//   import { useAuthStore } from '@/stores/authStore';
  
  const authStore = useAuthStore();
  const homestays = ref([]);
  const selectedHomestay = ref(null);
  const selectedDate = ref(new Date().toISOString().split('T')[0]);
  const rooms = ref([]);
  
  const getStatusClass = (status) => {
    const classes = {
      inactive: 'bg-gray-200',
      available: 'bg-white',
      booked: 'bg-yellow-200',
      checked_in: 'bg-red-200',
      checked_out: 'bg-orange-200',
      cleaned: 'bg-blue-200',
      completed: 'bg-green-200',
    };
    return classes[status] || 'bg-white';
  };
  
  const getStatusText = (status) => {
    const texts = {
      inactive: 'Ngưng hoạt động',
      available: 'Sẵn sàng',
      booked: 'Đã đặt',
      checked_in: 'Có khách',
      checked_out: 'Cần dọn',
      cleaned: 'Đang dọn',
      completed: 'Hoàn tất',
    };
    return texts[status] || 'Không xác định';
  };
  
  const fetchHomestays = async () => {
    try {
      const response = await axios.get('/api/homestays');
      homestays.value = response.data;
      if (homestays.value.length > 0) {
        selectedHomestay.value = homestays.value[0].id;
        fetchRoomStatus();
      }
    } catch (error) {
      console.error('Lỗi khi lấy danh sách homestay:', error);
    }
  };
  
  const fetchRoomStatus = async () => {
    if (!selectedHomestay.value || !selectedDate.value) return;
    try {
      const response = await axios.get('/api/rooms/status', {
        params: {
          homestay_id: selectedHomestay.value,
          date: selectedDate.value,
        },
      });
      rooms.value = response.data;
    } catch (error) {
      console.error('Lỗi khi lấy trạng thái phòng:', error);
    }
  };
  
  onMounted(() => {
    fetchHomestays();
    if (selectedHomestay.value) {
      window.Echo.channel(`homestay.${selectedHomestay.value}`)
        .listen('RoomStatusUpdated', (e) => {
          const room = rooms.value.find(r => r.id === e.roomId);
          if (room) {
            room.status = e.status;
          }
        });
    }
  });
  </script>