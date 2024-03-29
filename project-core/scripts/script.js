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

document.querySelectorAll('.faq .box-container .box h3').forEach(heading => {
  heading.onclick = () => {
    heading.parentElement.classList.toggle('active');
  }
});