//// check Session state for Preloader

// function hasVisitedBefore() {
//   return document.cookie.indexOf('visited=true') !== -1;
// }

// function setVisitedCookie() {
//   document.cookie = 'visited=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
// }
// function showBlockOnFirstVisit() {
//   if (!hasVisitedBefore()) {
//     // Show your block here
//     const block = document.getElementById("preloader");
//     if (block) {
//       block.style.display = 'block';
//     }

//     // Set the visited cookie to remember the user
//     setVisitedCookie();
//   }
// }

// showBlockOnFirstVisit();

// /// Preloader
// let preload = document.getElementById("preloader");
// if(preload){
//   setTimeout(() => {
//     fadeOut(preload, 300, () => {
//       preload.style.display = "none";

//     })
//   }, 5000)
// }

////// Youtube Banner Init
function loadYTPlayer() {
  if(typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
      const tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      const firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      ////////////// init all players
      window.onYouTubePlayerAPIReady = function () {
          initVideoBannerPlayer();
      };
  }
}

////// Youtube Banner Init
function initVideoBannerPlayer() {
  let players = document.querySelectorAll('.hero-video-banner .player');
  for (let i = 0; i < players.length; i++){
      let player;
      let wrapper = players[i].parentNode;

      player = new YT.Player(players[i], {
          height: '100%',
          width: '100%',
          videoId: players[i].getAttribute('data-video-id'),
          playerVars: {
              'modestbranding': 1,
              'autohide': 1,
              'showinfo': 0,
              'controls': 0,
              'mute': 1,
              'playsinline': 1,
              'loop': 1,
              'rel':0
          },
          events: {
              'onReady': onPlayerReady = (player, event) => {
                  player.target.playVideo();
              },
              'onStateChange': onPlayerStateChange = (event) => {
                  if (event.data === YT.PlayerState.PLAYING) {
                      setTimeout(function () {
                          wrapper.querySelector('.poster').classList.add('hidden');
                      }, 100);
                  }

                  if (event.data === YT.PlayerState.ENDED) {
                      player.playVideo(); 
                  }
              }
          }
      });
  }
}
loadYTPlayer();

let menuWrapp = document.querySelector(".menu-wrapper");
let allMenuItems = document.querySelectorAll(".menu-item");
let menuOpenButton = document.querySelector(".mobile-burger");
let menuCloseButton = document.querySelector(".close-menu");

allMenuItems.forEach((el) => {
  el.addEventListener("click", () => {
    window.closeMenu();
  })
})

////// FadeOut Custom Effect
function fadeOut(element, duration, callback) {
  let start = performance.now();
  let initialOpacity = parseFloat(window.getComputedStyle(element).opacity);

  function animate(currentTime) {
    let elapsedTime = currentTime - start;
    let opacity = Math.max(0, initialOpacity - (elapsedTime / duration));
    element.style.opacity = opacity;

    if (elapsedTime < duration) {
      requestAnimationFrame(animate);
    } else {
      if (typeof callback === 'function') {
        callback();
      }
    }
  }

  requestAnimationFrame(animate);
}

////// FadeIn Custom Effect
function fadeIn(element, duration) {
  let start = performance.now();

  element.style.display = 'block';
  element.style.opacity = '0';

  function animate(currentTime) {
    let elapsedTime = currentTime - start;
    element.style.opacity = Math.min(1, elapsedTime / duration);

    if (elapsedTime < duration) {
      requestAnimationFrame(animate);
    }
  }

  requestAnimationFrame(animate);
}

////// Open Menu Event 
function openMenu() {
  menuWrapp.classList.add("offcanvas");

  allMenuItems.forEach((el, i) => {
    setTimeout(() => {
      el.classList.add("menuItemsAnima");
    }, 100 + (i * 100));
  });

  let menuBackground = document.createElement("div");
  menuBackground.setAttribute("class", "menu-dim");
  menuBackground.style.position = "fixed";
  menuBackground.style.inset = "0";
  menuBackground.style.zIndex = "1";
  menuBackground.style.transition = "background 0.5s";
  menuBackground.style.background = "rgba(0, 0, 0, 0.6)";
  menuBackground.style.display = "none";
  menuBackground.style.height = "100vh";
  menuBackground.addEventListener("click", closeMenu);
  document.getElementById("header").appendChild(menuBackground);

  fadeIn(menuBackground, 500);
}

menuOpenButton.addEventListener("click", () => {
  openMenu();
});

///// Close Menu Event
window.closeMenu = function () {
  menuWrapp.classList.remove("offcanvas");
  allMenuItems.forEach((el) => {
    el.classList.remove("menuItemsAnima")
  })
  fadeOut(document.querySelector(".menu-dim"), 500, function () {
    document.querySelector(".menu-dim").remove();
  });
}

menuCloseButton.addEventListener("click", () => {
  window.closeMenu();
});

addEventListener('beforeunload', (event) => { window.closeMenu(); });


///// Next Section Event
let nextSectionButton = document.querySelector('.next-section-button');

if (nextSectionButton) {
  nextSectionButton.addEventListener('click', function () {
    let nextSection = getNextSiblingByTag(document.querySelector('section'));
    if (nextSection) {
      scrollToElement(nextSection, 1000, -120);
    }
  });
}


function getNextSiblingByTag(element) {
  let sibling = element.nextElementSibling;
  while (sibling) {
    if (sibling.tagName === 'SECTION') {
      return sibling;
    }
    sibling = sibling.nextElementSibling;
  }
  return null;
}

///// Scroll To Element Animation
function scrollToElement(element, duration, offset) {
  let start = performance.now();
  let from = window.scrollY;
  let to = element.offsetTop + (offset || 0);

  function animate(currentTime) {
    let elapsedTime = currentTime - start;
    let progress = Math.min(1, elapsedTime / duration);
    let scrollTop = from + (to - from) * progress;

    window.scrollTo({ behavior: 'smooth', top: scrollTop });

    if (elapsedTime < duration) {
      requestAnimationFrame(animate);
    }
  }

  requestAnimationFrame(animate);
}


///// Menu Click Anchor Scroll
let navLinks = document.querySelectorAll('ul.menu-ul li a');

navLinks.forEach(link => {
  link.addEventListener('click', event => {
    if (link.hash !== "") {
      event.preventDefault();

      let hash = link.hash;
      let targetElement = document.querySelector(hash);

      scrollToElement(targetElement, 500, -120);
    }
  });
});

///// Header Styles Scroll Changes
let scrollMain = document.querySelector("#main-content section:nth-child(2)");
let siteHeader = document.querySelector(".site-header");


function scrollHeader(el, pxToShowLogo) {
  if (el) {

    let windowNextSection = window;

    windowNextSection.addEventListener("scroll", () => {

      if (windowNextSection.scrollY >= pxToShowLogo) {
        siteHeader.classList.add("fixed-header-bg1");
      } else {
        siteHeader.classList.remove("fixed-header-bg1");
      }
    });
  }
}

scrollHeader()
let mediaHeader = window.matchMedia("(max-width: 767px)");
if(mediaHeader.matches){
  scrollHeader(scrollMain, 100);
}else{
  scrollHeader(scrollMain, 485);
}


///// Counters Animation

let a = 0;
let counter = document.getElementById('our-values');
if(counter){
  window.addEventListener('scroll', function() {
  
    let oTop = counter.offsetTop - window.innerHeight;
  
    if (a === 0 && window.pageYOffset > oTop) {
      let counterValues = document.querySelectorAll('.number-counter');
      counterValues.forEach(function(element) {
        let countTo = parseInt(element.getAttribute('data-count'), 10);
        let currentCount = parseInt(element.textContent, 10);
  
        let increment = countTo / 2000; // Increment per millisecond
        let startTime = null;
  
        function animateCounter(timestamp) {
          if (!startTime) startTime = timestamp;
          let progress = timestamp - startTime;
          let newCount = Math.min(countTo, currentCount + progress * increment);
  
          element.textContent = Math.floor(newCount);
  
          if (newCount < countTo) {
            requestAnimationFrame(animateCounter);
          } else {
            element.textContent = countTo;
          }
        }
  
        requestAnimationFrame(animateCounter);
      });
  
      a = 1;
    }
  });
}

///// Post Page Navigation
document.addEventListener('DOMContentLoaded', function () {
  let previousPageLink = document.querySelector(".back-button");

  if (previousPageLink) {
      previousPageLink.addEventListener('click', function (e) {
          e.preventDefault();
          history.go(-1); 
      });
  }
});





