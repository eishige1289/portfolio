// animation
const animate = (elm) => {
  if (elm !== null && elm !== undefined) {
    elm.classList.remove('animated');
    elm.offsetWidth = elm.offsetWidth;
    elm.classList.add('animated');
  }
};
//observer
const boxes = document.querySelectorAll('.animation');
const options = {
  root: null, // 今回はビューポートをルート要素とする
  rootMargin: '0px 0px',
  threshold: 0, // 閾値は0
};
const observer = new IntersectionObserver(doWhenIntersect, options);
function doWhenIntersect(entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animated');
    }
  });
}
boxes.forEach((box) => {
  observer.observe(box);
});
//スムーススクロール
$('a[href^="#"]').on('click', function () {
  var header = $('#header'); //ヘッダー
  var headerHeight = header.height(); //ヘッダーの高さ取得
  var speed = 800;
  var href = $(this).attr('href');
  var target = $(href == '#' || href == '' ? 'html' : href);
  var position = target.offset().top - headerHeight; // - headerHeight :ヘッダーの高さ分ずらす
  $('body,html').stop().animate({ scrollTop: position }, speed, 'swing');
});
//ハンバーガーメニュー
const menu = document.querySelector(".nav-container");
const button = document.querySelector(".hamburger-menu-btn");
const items = document.querySelectorAll(".nav-container .nav-list a");
const body = document.body;
const toggleMenu = () => {
  menu.classList.toggle("open");
  button.classList.toggle("open");
  body.classList.toggle("scroll_allowed");
};
button.addEventListener("click", () => {
  toggleMenu();
});
if(items.length > 0){
  for (let i = 0; i < items.length; i++) {
    let item = items[i];
    item.addEventListener("click", (e) => {
      toggleMenu();
    });
  }
}
