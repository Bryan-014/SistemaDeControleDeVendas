$(document).ready(() => {
  listUser();
});

const listUser = () => {
  $.ajax({
    url: './assets/php/user/listUser.php'
  }).done(response => {
    document.querySelector('#list_user').innerHTML = response;
    //closeLoading();
  });
};
