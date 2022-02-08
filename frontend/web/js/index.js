
let header = document.querySelector('.head')

window.onscroll = function () {
  if (window.pageYOffset > 70) {
    header.style.background = "rgba(0, 0, 0, 0.7)";
  }
  else if (window.scrollY < 70) {
    header.style.background = "rgba(0,0,0,0)";
  }
}


if (document.querySelector('#swiper-recall')) {
  let profileSlideOffset = (window.innerWidth - document.querySelector('#wrap').clientWidth) / 2
  const profileSlider = new Swiper('#swiper-recall', {
    speed: 400,
    direction: 'horizontal',
    slidesPerView: "auto",
    slidesOffsetBefore: profileSlideOffset,
    slidesOffsetAfter: profileSlideOffset,
    spaceBetween: 30,
  })
};


if (document.querySelector('.popular-slider')) {
  const popularSlider = new Swiper('.popular-slider', {
    spaceBetween: 0,
    slidesPerView: 1,
    speed: 600,
    effect: 'fade',
    // loop: true,
    autoplay: {
      delay: 4000,
    },
    pagination: {
      el: '.popular-pagination',
      type: 'bullets',
      clickable: true,
      bulletClass: 'popular-pagination-item',
      bulletActiveClass: 'active',
      dynamicBullets: true,
      renderBullet: function (index, className) {
        var wrapper = document.createElement('div')
        var item = document.createElement('img')
        var path = this.slides[index].querySelector('img').getAttribute('src')
        item.src = path
        wrapper.append(item)
        item.className = className

        return wrapper.innerHTML;
      }
    },
  })
};


const modalOpen = document.querySelector('.footer-block__btn')

if (modalOpen)
  modalOpen.addEventListener('click', function(){
    modal.classList.add('activity')
    document.body.style.overflow = "hidden"
  })


let active = document.querySelectorAll('.items-block__point')
let hide = document.querySelectorAll('.hide')


if (active)
  active.forEach(function (entry) {
    entry.addEventListener('click', function () {
      entry.classList.toggle('active')
      hide.classList.toggle('hide')
    });
  });


let herobtn = document.querySelector('.hero-block__btn')
let modal = document.querySelector('.modal')
let exit = document.querySelector('.modal-block__exit')

if (herobtn) {
  herobtn.addEventListener('click', function () {
    modal.classList.add('activity')
    document.body.style.overflow = "hidden"
  })
}

if (exit) {
  exit.addEventListener('click', function () {
    modal.classList.remove('activity')
    document.body.style.overflow = "visible"
  })
}


let recallmodal = document.querySelector('.recallmodal')
let exitmodal = document.querySelector('.recallmodal-block__exit')
let openmodal = document.querySelectorAll('.recall-block__readmore')


if (openmodal)
  openmodal.forEach(function (entrys) {
    entrys.addEventListener('click', function () {
      recallmodal.classList.add('show')
      document.body.style.overflow = "hidden"
    });
  });


if (exitmodal) {
  exitmodal.addEventListener('click', function () {
    recallmodal.classList.remove('show')
    document.body.style.overflow = "visible"
  })
}

let menuBtn = document.querySelector('.burger-menu');
let menu = document.querySelector('.menu')
let menublock = document.querySelector('.menu-block')

if (menuBtn) {
  menuBtn.addEventListener('click', function () {
    menu.classList.add('burgershow')
    menuBg.classList.toggle('active')
    document.body.style.overflow = "hidden"
  })
}




const hideMenu = document.querySelector('.menu-block')
const menuBg = document.querySelector('.menu-bg')
document.addEventListener('click', (e) => {
  if (e.target === menuBg) {
    menu.classList.remove('burgershow')
    menuBg.classList.remove('active')
    document.body.style.overflow = "auto"
  }
})

//FAQ
const faqItems = document.querySelectorAll('.point-block.mobile .point-block__item')

if (faqItems.length > 0)
  faqItems.forEach((item) => {
    const faqHead = item.querySelector('.point-block__title')
    const faqArrow = item.querySelector('.point-block__arrow')
    faqHead.addEventListener('click', () => {
      item.classList.toggle('opened')
      faqArrow.classList.toggle('rotate-90')
    })
  });

//Валидация
$("#cphone").mask("+7 (000) 000-00-00");

$.validator.addMethod("pwcheckallowedchars", function (value) {
  return /^[a-zA-Zа-яА-я-()ёЁ ]+$/.test(value)
}, "Недопустимое значение");

$('.form-block__action').validate({
  rules: {
    cname: {
      required: true,
      minlength: 2,
      pwcheckallowedchars: true
    },
    cemail: {
      required: true,
      email: true
    },
    cphone: {
      required: true,
      minlength: 18
    },
    area: {
      required: true,
      maxlength: 10000
    }
  },
  messages: {
    cname: {
      required: 'Поле не заполнено',
      minlength: 'Минимум 2 символа'
    },
    cemail: {
      required: 'Поле не заполнено',
      email: 'Введите правильный email'
    },
    cphone: {
      required: 'Поле не заполнено',
      minlength: 'Введите номер полностью'
    },
    area: {
      required: 'Поле не заполнено',
      minlength: 'Минимум 10 символов',
      maxlength: 'Максимум 10000 символов'
    }
  },
  onkeyup: function (element) {
    let submit = document.querySelector('#form-block__action .form-block__button')

    if ($('#form-block__action').validate().checkForm()) {
      submit.classList.remove('disabled')
    } else {
      submit.classList.add('disabled')
    }
    var excludedKeys = [
      16, 17, 18, 20, 35, 36, 37,
      38, 39, 40, 45, 144, 225
    ];
    if (event.which === 9 && this.elementValue(element) === "" || $.inArray(event.keyCode, excludedKeys) !== -1) {
      return;
    } else if (element.name in this.submitted || element.name in this.invalid) {
      this.element(element);
    }
  },
});

//Выбор фильтра
function toggleClass(elem, className) {
  if (elem.className.indexOf(className) !== -1) {
    elem.className = elem.className.replace(className, '');
  }
  else {
    elem.className = elem.className.replace(/\s+/g, ' ') + ' ' + className;
  }

  return elem;
}

function toggleMenuDisplay(e) {
  const dropdown = e.currentTarget.parentNode;
  const menu = dropdown.querySelector('.menuitems');
  const icon = dropdown.querySelector('.fa-angle-right');

  toggleClass(menu, 'hide');
  toggleClass(icon, 'rotate-90');
}

function handleOptionSelected(e) {
  toggleClass(e.target.parentNode, 'hide');

  const id = e.target.id;
  const newValue = e.target.textContent + ' ';
  const titleElem = document.querySelector('.dropdown .titleitems');
  const icon = document.querySelector('.dropdown .titleitems .fa');


  titleElem.textContent = newValue;
  titleElem.appendChild(icon);

  document.querySelector('.dropdown .titleitems').dispatchEvent(new Event('change'));
  setTimeout(() => toggleClass(icon, 'rotate-90', 0));
}


const dropdownTitle = document.querySelector('.dropdown .titleitems');
const dropdownOptions = document.querySelectorAll('.dropdown .option');

if (dropdownTitle)
  dropdownTitle.addEventListener('click', toggleMenuDisplay);

dropdownOptions.forEach(option => option.addEventListener('click', handleOptionSelected));