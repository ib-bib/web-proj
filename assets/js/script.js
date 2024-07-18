window.addEventListener("scroll", function () {
  const navbar = document.getElementById("navbar");
  if (window.scrollY > 1) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
});

const toOrderPage = (serviceId, tierId) => {
  sessionStorage.setItem("selectedServiceId", serviceId);
  sessionStorage.setItem("selectedTierId", tierId);
  window.location.href = "order.php";
};
