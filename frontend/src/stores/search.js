import { defineStore } from 'pinia';

export const useSearchStore = defineStore('search', {
  state: () => ({
    checkIn: '',
    checkOut: '',
    sucChua: 1,
    results: [], // Lưu danh sách homestay từ lần tìm kiếm cuối cùng
  }),
  actions: {
    setSearchCriteria(checkIn, checkOut, sucChua) {
      this.checkIn = checkIn;
      this.checkOut = checkOut;
      this.sucChua = sucChua;
    },
    setSearchResults(results) {
      this.results = results;
    },
    clearSearch() {
      this.checkIn = '';
      this.checkOut = '';
      this.sucChua = 1;
      this.results = [];
    },
  },
  getters: {
    hasSearchCriteria(state) {
      return state.checkIn !== '' && state.checkOut !== '' && state.sucChua !== 0;
    },
  },
});