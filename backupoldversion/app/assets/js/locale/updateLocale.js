$(document).ready(() => {
  updateLocation();
});

function updateLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    function showPosition(position) {
      $.ajax({
        url: './assets/php/util/updateLocale.php',
        method: 'POST',
        data: {
          lati: position.coords.latitude,
          longi: position.coords.longitude
        }
      });
    }
  }
}
