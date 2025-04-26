<template>
    <div class="steps-container">
      <div
        v-for="(step, index) in steps"
        :key="index"
        class="step-item"
      >
        <div
          class="step-circle"
          :class="{ active: currentStep === index + 1 }"
        >
          {{ index + 1 }}
        </div>
        <div
          class="step-label"
          :class="{ activeText: currentStep === index + 1 }"
        >
          {{ step }}
        </div>
        <div v-if="index < steps.length - 1" class="step-arrow">→</div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Steps",
    props: {
      currentStep: Number,
    },
    data() {
      return {
        steps: ["Bạn chọn", "Chi tiết về bạn", "Hoàn tất đặt phòng"],
      };
    },
  };
  </script>
  
  <style scoped>
  .steps-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: nowrap;
    gap: 16px;
    padding: 10px 0;
    overflow-x: auto;
  }
  
  .step-item {
    display: flex;
    align-items: center;
    flex-shrink: 0;
  }
  
  .step-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #e2e2e2;
    color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
  }
  
  .step-circle.active {
    background-color: #0071c2;
    color: #fff;
  }
  
  .step-label {
    margin-left: 8px;
    font-weight: 500;
    color: #888;
    white-space: nowrap;
  }
  
  .step-label.activeText {
    color: #000;
  }
  
  .step-arrow {
    margin: 0 10px;
    color: #ccc;
    font-size: 18px;
    flex-shrink: 0;
  }
  
  /* Mobile: Thu gọn label */
  @media (max-width: 600px) {
  .step-label {
    font-size: 0.8rem;         /* nhỏ lại */
    max-width: 90%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 400;
  }

  .step-circle {
    width: 1.5rem;
    height: 1.5rem;
    font-size: 14px;
    font-weight: 300;
  }

  .steps-container {
    gap: 6px;
  }

  .step-arrow {
    margin: 0 4px;
    font-size: 1rem;
  }
}

  </style>
  