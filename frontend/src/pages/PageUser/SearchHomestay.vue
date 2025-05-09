<template>
  <div class="search-room-container">
    <!-- Thanh tìm kiếm -->
    <form
      @submit.prevent="search"
      class="bg-white shadow-sm p-4 rounded-4 border mb-4"
    >
      <div class="row g-2 align-items-center">
        <!-- Ngày nhận phòng -->
        <div class="col-lg-3 col-md-6">
          <label class="form-label fw-semibold">Ngày nhận phòng</label>
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="fa-regular fa-calendar"></i>
            </span>
            <input
              type="date"
              class="form-control rounded-start-0"
              v-model="form.check_in"
              :min="today"
              required
            />
          </div>
        </div>

        <!-- Ngày trả phòng -->
        <div class="col-lg-3 col-md-6">
          <label class="form-label fw-semibold">Ngày trả phòng</label>
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="fa-regular fa-calendar-check"></i>
            </span>
            <input
              type="date"
              class="form-control rounded-start-0"
              v-model="form.check_out"
              :min="minCheckOut"
              required
            />
          </div>
        </div>

        <!-- Số người -->
        <div class="col-lg-3 col-md-6">
          <label class="form-label fw-semibold">Số người</label>
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0">
              <i class="fa-solid fa-user-group"></i>
            </span>
            <select
              class="form-select rounded-start-0"
              v-model="form.suc_chua"
              required
            >
              <option v-for="n in 10" :key="n" :value="n">{{ n }} người</option>
            </select>
          </div>
        </div>

        <!-- Nút tìm kiếm -->
        <div class="col-lg-3 col-md-6 d-grid">
          <label class="form-label d-none d-md-block"> </label>
          <button type="submit" class="btn btn-primary rounded-pill">
            <i class="fa fa-search me-2"></i> Tìm kiếm
          </button>
        </div>
      </div>
    </form>

    <!-- Hiển thị thông báo lỗi -->
    <div v-if="errorMessage" class="mt-4">
      <p class="text-danger">{{ errorMessage }}</p>
    </div>

    <!-- Kết quả tìm kiếm -->
    <div v-if="displayedResults.length" class="mt-4">
      <h4>Kết quả tìm kiếm ({{ displayedResults.length }} homestay)</h4>
      <div class="row">
        <div
          v-for="homestay in displayedResults"
          :key="homestay.id"
          class="col-md-12 mb-3"
        >
          <div class="card shadow-sm border-0 rounded-4">
            <div class="row g-0">
              <div class="col-md-4 position-relative">
                <img
                  :src="
                    homestay.anh_chinh
                      ? 'http://127.0.0.1:8000/storage/' + homestay.anh_chinh
                      : 'https://via.placeholder.com/300x200'
                  "
                  class="w-100 radius-30"
                  style="object-fit: cover; max-height: 300px;"
                  alt="homestay"
                />
                <i
                  class="fa-regular fa-heart"
                  style="
                    background-color: white;
                    padding: 5px;
                    border-radius: 50%;
                    position: absolute;
                    top: 15px;
                    right: 15px;
                    font-size: 1rem;
                    color: red;
                    cursor: pointer;
                    z-index: 2;
                  "
                ></i>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title fw-bold mb-1" style="color: #003087">
                    {{ homestay.ten_homestay }}
                  </h5>
                  <p class="mb-1 text-decoration-underline text-muted small">
                    {{ homestay.dia_chi }} ·
                    <a href="#">Xem trên bản đồ</a>
                  </p>
                  <p class="mb-2 text-muted small">{{ homestay.mo_ta }}</p>
                  <p class="mb-2" v-html="homestay.tien_ich"></p>

                  <!-- Danh sách phòng sẽ hiển thị khi bấm vào homestay -->
                  

                  <div class="d-flex justify-content-end">
                   
                    <router-link
                      :to="{
                        name: 'HomestayDetail',
                        params: { id: homestay.id },
                        query: {
                          checkIn: searchStore.checkIn,
                          checkOut: searchStore.checkOut,
                          sucChua: searchStore.sucChua,
                        },
                      }"
                      class="btn btn-primary"
                    >
                      Xem chi tiết
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Không có kết quả -->
    <div
      v-else-if="searched && !displayedResults.length && !errorMessage"
      class="mt-4"
    >
      <p class="text-muted">
        Không tìm thấy homestay phù hợp với yêu cầu của bạn.
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { useSearchStore } from "../../stores/search";

export default {
  setup() {
    const searchStore = useSearchStore();
    return { searchStore };
  },
  data() {
    return {
      form: {
        check_in: "",
        check_out: "",
        suc_chua: 1,
      },
      searched: false,
      errorMessage: "",
      today: new Date().toISOString().split("T")[0],
      selectedHomestayId: null,
      rooms: [],
    };
  },
  computed: {
    minCheckOut() {
      if (!this.form.check_in) return this.today;
      const checkInDate = new Date(this.form.check_in);
      checkInDate.setDate(checkInDate.getDate() + 1);
      return checkInDate.toISOString().split("T")[0];
    },
    displayedResults() {
      return this.searchStore.results;
    },
  },
  mounted() {
    if (this.searchStore.hasSearchCriteria) {
      this.form.check_in = this.searchStore.checkIn;
      this.form.check_out = this.searchStore.checkOut;
      this.form.suc_chua = this.searchStore.sucChua;
      this.searched = true;
    }
    console.log("Mounted - Results:", this.displayedResults);
  },
  methods: {
    search() {
      this.searched = true;
      this.errorMessage = "";

      this.searchStore.setSearchCriteria(
        this.form.check_in,
        this.form.check_out,
        this.form.suc_chua
      );

      const { check_in, check_out, suc_chua } = this.form;
      axios
        .get("http://127.0.0.1:8000/api/homestays/search", {
          params: {
            check_in,
            check_out,
            suc_chua,
          },
        })
        .then((response) => {
          this.searchStore.setSearchResults(response.data);
          this.selectedHomestayId = null;
          this.rooms = [];
          console.log("Search Results:", response.data);
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
          this.searchStore.setSearchResults([]);
          this.errorMessage =
            "Có lỗi xảy ra khi tìm kiếm homestay. Vui lòng thử lại sau.";
        });
    },
    async toggleRooms(homestayId) {
      if (this.selectedHomestayId === homestayId) {
        this.selectedHomestayId = null;
        this.rooms = [];
        return;
      }

      this.selectedHomestayId = homestayId;

      const { checkIn, checkOut, sucChua } = this.searchStore;

      if (!checkIn || !checkOut || !sucChua) {
        this.errorMessage =
          "Vui lòng nhập thông tin tìm kiếm trước khi xem phòng.";
        return;
      }

      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/homestays/${homestayId}/rooms`,
          {
            params: {
              check_in: checkIn,
              check_out: checkOut,
              suc_chua: sucChua,
            },
          }
        );
        this.rooms = response.data;
      } catch (error) {
        console.error("Error fetching rooms:", error);
        this.rooms = [];
        this.errorMessage =
          "Có lỗi xảy ra khi lấy danh sách phòng. Vui lòng thử lại sau.";
      }
    },
    formatPrice(price) {
      return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
  },
};
</script>

<style scoped>
.search-room-container {
  max-width: 1200px;
  margin: 0 auto;
}

.radius-30 {
  border-radius: 30px !important;
}

.card {
  transition: transform 0.2s;
}

.card:hover {
  transform: translateY(-5px);
}

.input-group-text {
  border-right: 0;
  background-color: #f8f9fa;
}

.input-group .form-control,
.input-group .form-select {
  border-left: 0;
}

.mr-2 {
  margin-right: 0.5rem;
}
</style>