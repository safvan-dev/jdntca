//    header

  window.addEventListener("scroll", function() {
    if (window.scrollY > 50) {
      document.body.classList.add("scrolled");
    } else {
      document.body.classList.remove("scrolled");
    }
  });

//   ////
// header for smart phone

  document.getElementById("menu-toggle").addEventListener("click", function () {
    document.getElementById("nav-menu").classList.toggle("show");
  });

// ///
   
   // set copyright year
    document.getElementById('y').textContent = new Date().getFullYear();

    // caorusel slider

// document.addEventListener('DOMContentLoaded', function () {
//     var el = document.getElementById('heroCarousel');
//     if (!el) return;
//     // create or get instance safely (Bootstrap 5.3+)
//     var carousel = bootstrap.Carousel.getOrCreateInstance(el, {
//       interval: 6000,
//       pause: 'hover',
//       wrap: true
//     });
//     // ensure it's running
//     if (typeof carousel.cycle === 'function') carousel.cycle();
//   });



  // //
  // Counter animation on scroll
function animateCounter(numElement) {
  const target = +numElement.getAttribute("data-target");
  const suffix = numElement.getAttribute("data-suffix") || "";
  let count = 0;
  const increment = target / 100; // adjust speed here

  const update = () => {
    count += increment;
    if (count < target) {
      numElement.textContent = Math.floor(count) + suffix;
      requestAnimationFrame(update);
    } else {
      numElement.textContent = target + suffix;
    }
  };
  update();
}

const counters = document.querySelectorAll('.num');

counters.forEach(counter => {
  let target = +counter.getAttribute('data-target');
  let count = 0;
  let speed = 50; // smaller = faster

  let updateCount = setInterval(() => {
    if (count < target) {
      count++;
      counter.textContent = count;
    } else {
      counter.textContent = target + "+"; // ✅ add "+" at the end
      clearInterval(updateCount);
    }
  }, speed);
});


// Detect when stats section is in view
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const nums = entry.target.querySelectorAll(".num");
      nums.forEach(num => {
        if (!num.classList.contains("counted")) {
          animateCounter(num);
          num.classList.add("counted");
        }
      });
    }
  });
}, { threshold: 0.5 });

observer.observe(document.querySelector("#about .stats"));


// ///words breacking

document.querySelectorAll(".service p").forEach(p => {
  const words = p.innerText.trim().split(/\s+/);
  if (words.length > 30) {
    p.innerText = words.slice(0, 20).join(" ") + "...";
  }
});

// //


     // Join / Login
  function openJoinLogin() {
    window.open('https://mail.google.com/', '_blank');
  }

  // Staff Login
  function openStaffLogin() {
    window.open('https://flowforms.farmlogics.com/login', '_blank');
  }


  // career page

  document.getElementById('year').textContent = new Date().getFullYear();


// Simple client-side handlers (replace with real backend integration)
function handleSubmit(e){
e.preventDefault();
const btn = document.getElementById('submit-btn');
btn.disabled = true;
btn.textContent = 'Submitting...';


// Collect data (in production send via fetch to server)
const form = document.getElementById('spec-form');
const data = new FormData(form);


// Fake delay to show feedback (WCAG-friendly live region used earlier)
setTimeout(()=>{
btn.disabled = false;
btn.textContent = 'Submit application';
alert('Thanks! Your application has been received. We will contact you if a relevant position opens.');
form.reset();
},900);
}


function subscribe(e){
e.preventDefault();
const email = document.getElementById('sub-email').value;
if(!email) return; // minimal
alert('Thanks — we added ' + email + ' to the careers list.');
e.target.reset();
}


function downloadTemplate(){
const txt = 'Resume tips:\n\n1) Keep it concise (1-2 pages).\n2) Highlight relevant certifications and experience.\n3) Include measurable achievements.\n4) Save as PDF before sending.';
const blob = new Blob([txt],{type:'text/plain'});
const url = URL.createObjectURL(blob);
const a = document.createElement('a');
a.href = url; a.download = 'resume-tips.txt';
document.body.appendChild(a); a.click(); a.remove();
URL.revokeObjectURL(url);
}
