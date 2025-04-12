<template>
  <div class="container bg-primary-dark p-2 my-4 rounded" style="max-width: 1000px;">
    <form @submit.prevent="searchRooms">
      <div class="row g-2 align-items-center">
        <!-- Điểm đến -->
        <div class="col-md-4 col-12">
          <div class="input-group bg-white rounded align-items-center h-100" style="max-height: 50px;">
            <label class="p-2 fs-4"><i class="fa-solid fa-location-dot"></i></label>
            <select
              class="form-select border-0 fs-6"
              v-model="form.destination"
            >
              <option disabled value="">Chọn điểm đến</option>
              <option value="danang">Đà Nẵng</option>
              <option value="hanoi">Hà Nội</option>
              <option value="hcm">TP. Hồ Chí Minh</option>
            </select>
          </div>
        </div>

        <!-- Ngày nhận - trả phòng -->
        <div class="col-md-4 col-12">
          <VueDatePicker
            v-model="form.dates"
            range
            :multi-calendars="isDesktop"
            :min-date="today"
            :disabled-dates="disabledDates"
            :enable-time-picker="false"
            placeholder="Chọn khoảng ngày"
            input-class-name="custom-datepicker"
          />
        </div>

        <!-- Số người và nút tìm kiếm -->
        <div class="col-md-4 col-12 d-flex align-items-center gap-2">
          <div class="flex-grow-1 input-group bg-white rounded h-100">
            <label class="ps-2 fs-5">
              <i class="fa-solid fa-user"></i>
            </label>
            <input
              type="number"
              class="form-control border-0 text-center"
              min="1"
              v-model="form.guests"
              readonly
              :class="p-0"
            />
            <div class="input-group-append d-flex">
              <button
                type="button"
                class="btn btn-outline-secondary border-0"
                @click="decrementGuests"
              >
                <i class="fa-solid fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-outline-secondary border-0"
                @click="incrementGuests"
              >
                <i class="fa-solid fa-plus"></i>
              </button>
            </div>
          </div>
          <button class="btn btn-light h-100 px-4" type="submit">
            <i class="bi bi-search"></i> Tìm
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

const today = new Date()

const form = ref({
  destination: '',
  dates: null,
  guests: 1,
})

// Track screen size to toggle multi-calendars
const isDesktop = ref(window.innerWidth >= 768)

const updateScreenSize = () => {
  isDesktop.value = window.innerWidth >= 768
}

// Add event listener for window resize
onMounted(() => {
  window.addEventListener('resize', updateScreenSize)
  const startDate = new Date()
  const endDate = new Date(new Date().setDate(startDate.getDate() + 7))
  form.value.dates = [startDate, endDate]
})

// Clean up event listener on component unmount
onUnmounted(() => {
  window.removeEventListener('resize', updateScreenSize)
})

// Ràng buộc ngày không hợp lệ
const disabledDates = (date) => {
  const checkIn = form.value.dates?.[0]
  if (checkIn && date <= checkIn) return true
  return date < today
}

// Tăng số người
const incrementGuests = () => {
  form.value.guests++
}

// Giảm số người
const decrementGuests = () => {
  if (form.value.guests > 1) {
    form.value.guests--
  }
}

const searchRooms = () => {
  const [checkIn, checkOut] = form.value.dates || []
  if (!checkIn || !checkOut) {
    alert('Vui lòng chọn đầy đủ ngày nhận và trả phòng.')
    return
  }

  console.log('Tìm kiếm với:', {
    destination: form.value.destination,
    checkIn,
    checkOut,
    guests: form.value.guests,
  })

  // TODO: Gửi API hoặc emit event ra component cha
}
</script>

<style scoped>
.bg-primary-dark {
  background-color: #003087; /* Dark blue background */
}

.input-group,
.form-control,
.custom-datepicker,
.btn-light {
  height: 48px; /* Consistent height for all inputs */
  box-sizing: border-box;
}

.input-group {
  display: flex;
  align-items: center;
}

.form-select {
  background-color: transparent;
  padding: 0 10px;
}

.dp__input_wrap {
  background: white;
  border-radius: 5px;
  height: 48px !important; /* Force the wrapper to match the height */
  display: flex;
  align-items: center;
}

.dp__input {
  border: none !important;
  background: transparent;
  height: 100% !important; /* Ensure the input fills the wrapper */
  padding: 0 15px;
  font-size: 1rem;
  line-height: normal; /* Prevent line-height from affecting height */
}

.dp__input_icon {
  padding-left: 10px; /* Adjust icon padding for alignment */
}

.dp__clear_icon {
  padding-right: 10px; /* Adjust clear icon padding */
}

.btn-light {
  font-weight: 500;
  color: #003087;
  border: none;
}

.btn-light:hover {
  background-color: #f0f0f0;
}

.btn-outline-secondary {
  padding: 3px 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-outline-secondary i {
  font-size: 0.9rem;
}

.form-control[readonly] {
  background: transparent;
  cursor: default;
}

@media (max-width: 767px) {
  .col-12:not(:last-child) {
    margin-bottom: 0.5rem;
  }
}
</style>