import { defineStore } from 'pinia';

export const useBookingStore = defineStore('booking', {
  state: () => ({
    selectedRooms: [], // Danh sách phòng đã chọn
    homestayId: null,  // ID homestay
    checkIn: '',       // Ngày nhận phòng
    checkOut: '',      // Ngày trả phòng
    totalGuests: 0,    // Tổng số người
  }),
  actions: {
    setBookingData({ selectedRooms, homestayId, checkIn, checkOut, totalGuests }) {
      this.selectedRooms = selectedRooms;
      this.homestayId = homestayId;
      this.checkIn = checkIn;
      this.checkOut = checkOut;
      this.totalGuests = totalGuests;
    },
    addRoom(room) {
      const existingRoom = this.selectedRooms.find(r => r.roomId === room.roomId);
      if (!existingRoom) {
        this.selectedRooms.push(room);
      }
    },
    removeRoom(roomId) {
      this.selectedRooms = this.selectedRooms.filter(r => r.roomId !== roomId);
    },
    updateTotalGuests(rooms, allRooms) {
      this.totalGuests = rooms.reduce((total, room) => {
        const roomData = allRooms.find(r => r.id === room.roomId);
        return total + (roomData ? roomData.suc_chua * room.quantity : 0);
      }, 0);
    },
    clearBookingData() {
      this.selectedRooms = [];
      this.homestayId = null;
      this.checkIn = '';
      this.checkOut = '';
      this.totalGuests = 0;
    },
  },
});