let menu = document.querySelector('.header .menu');

document.getElementById('menu-btn').onclick = () => {
  menu.classList.toggle('active');
}

window.onscroll = () => {
  menu.classList.remove('active');
}

document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
  inputNumber.oninput = () => {
    if (inputNumber.value.length > inputNumber.maxLength) inputNumber.value = inputNumber.value.slice(0, inputNumber.maxLength);
  }
});

document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
  inputNumber.oninput = () => {
    if (inputNumber.value.length > inputNumber.maxLength) inputNumber.value = inputNumber.value.slice(0, inputNumber.maxLength);
  }
});

let filter = document.querySelector('.filter-search');

document.querySelector('#open-filter').onclick = () => {
  filter.classList.add('active');
}

document.querySelector('#close-filter').onclick = () => {
  filter.classList.remove('active');
}