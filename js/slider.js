

document.addEventListener('DOMContentLoaded', function () {
    // Dropdown Functionality for Level Two and Level Three
    const levelTwoLinks = document.querySelectorAll('.dropdown-content > a');
    const dropdownSubcontent = document.querySelector('.dropdown-subcontent');
    const dropdownSubcontentLevel3 = document.querySelector('.dropdown-subcontent-level3');
    const dropdownSubcontentLevel3Links = document.querySelectorAll('.dropdown-subcontent-level3 > a');
    
    levelTwoLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action

            const hasSubcontent = this.nextElementSibling && this.nextElementSibling.classList.contains('dropdown-subcontent');
            if (hasSubcontent) {
                // Toggle the visibility of the next level
                const nextSubcontent = this.nextElementSibling;
                if (nextSubcontent.classList.contains('show')) {
                    nextSubcontent.classList.remove('show');
                } else {
                    nextSubcontent.classList.add('show');
                }
            }
        });
    });

    // Handle the Level Three dropdown toggling
    dropdownSubcontentLevel3Links.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action

            // Toggle the visibility of the Level Three subcontent
            if (dropdownSubcontentLevel3.classList.contains('show')) {
                dropdownSubcontentLevel3.classList.remove('show');
            } else {
                dropdownSubcontentLevel3.classList.add('show');
            }
        });
    });
});
const subdiv = document.querySelector('.subdiv-1');
const posts = document.querySelectorAll('.post-div');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

let currentIndex = 0;

function showSlide(index) {
    if (index >= posts.length) {
        currentIndex = 0;
    } else if (index < 0) {
        currentIndex = posts.length - 1;
    } else {
        currentIndex = index;
    }
    subdiv.style.transform = `translateX(-${currentIndex * 100}%)`;
}

nextBtn.addEventListener('click', () => {
    showSlide(currentIndex + 1);
});

prevBtn.addEventListener('click', () => {
    showSlide(currentIndex - 1);
});
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    document.querySelector('.prev-btn').addEventListener('click', function () {
        currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
        showSlide(currentSlide);
    });

    document.querySelector('.next-btn').addEventListener('click', function () {
        currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0;
        showSlide(currentSlide);
    });
});
jQuery(document).ready(function($) {
    let currentSlide = 0;
    const slides = $('.slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.removeClass('active').eq(index).addClass('active');
    }

    $('.next-btn').click(function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    });

    $('.prev-btn').click(function() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    });
});
