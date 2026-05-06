const closeLoading = () => {
  document.querySelector('#loading').classList.add('close');
  setTimeout(() => {
    document.querySelector('#loading').classList.add('stay-close');
    document.querySelector('#loading').classList.remove('stay-open');
  }, 300);
};

const openLoading = () => {
  document.querySelector('#loading').classList.add('open');
  setTimeout(() => {
    document.querySelector('#loading').classList.add('stay-open');
    document.querySelector('#loading').classList.remove('stay-close');
  }, 150);
};

for (let index = 1; index <= 6; index++) {
  document.querySelector('#drop' + index).addEventListener('click', () => {
    openLoading();
  });
}