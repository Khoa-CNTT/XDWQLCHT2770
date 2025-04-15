<template >
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../../../public/slide1.png" class="d-block w-100 banner-response" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://i.pinimg.com/736x/9f/53/38/9f5338d158f65e163ffb3eaf0702a01a.jpg" class="d-block w-100 banner-response" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://th.bing.com/th?q=Raja+Ampat+Homestay&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=2.2&pid=InlineBlock&mkt=en-WW&cc=VN&setlang=en&adlt=moderate&t=1&mw=247" class="d-block w-100 banner-response" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</template>
<script>
export default {};
</script>
<style>
.banner-response {
  width: 100%;
  height: 500px;
  object-fit: cover;
}
@media (max-width: 768px) {
  .banner-response {
    height: 300px;
  }
}
</style>