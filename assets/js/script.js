/* Author: Ibrahim
Created: July 14
Modified: July 18
*/

// A function to change the look of the navigation bar when you scroll down
window.addEventListener("scroll", function () {
  const navbar = document.getElementById("navbar");
  if (window.scrollY > 1) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
});

// setting values in the session in order to streamline order process from service page or pricing page
const toOrderPage = (serviceId, tierId) => {
  sessionStorage.setItem("selectedServiceId", serviceId);
  sessionStorage.setItem("selectedTierId", tierId);
  window.location.href = "order.php";
};
