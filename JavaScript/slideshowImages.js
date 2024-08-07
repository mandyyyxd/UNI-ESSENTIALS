const imagesTechnology = [
    { src: '../Images/Product Images/3.jpg', name: 'MacBook Air 13" M3 8-Core CPU 8-Core GPU 8/256GB Midnight' },
    { src: '../Images/Product Images/4.jpg', name: 'MacBook Pro 14" M3 8-Core CPU 10-Core GPU 8/512GB Space Grey' },
    { src: '../Images/Product Images/5.jpg', name: 'Acer 14" Aspire 1 Celeron 8GB RAM/128GB eMMC Laptop Silver' },
    { src: '../Images/Product Images/6.jpg', name: 'Lenovo 14" Yoga 7i 2-in-1 Laptop EVO Core i7/16GB/512GB' },
    { src: '../Images/Product Images/7.jpg', name: 'HP Pavilion x360 14" 16/512GB i7 2-in-1 Laptop' },
    { src: '../Images/Product Images/8.jpg', name: 'ASUS ROG Flow X13 Ryzen 9 16/512GB AMD Radeon Gaming Laptop' },
    { src: '../Images/Product Images/9.jpg', name: 'iPad Pro (4th Gen) 11" WiFi 256GB Space Grey' },
    { src: '../Images/Product Images/10.jpg', name: 'iPad Pro (6th Gen) 12.9" WiFi 256GB Space Grey' },
    { src: '../Images/Product Images/11.jpg', name: 'Samsung Galaxy Tab S9 WiFi 12GB/256GB Graphite' },
    { src: '../Images/Product Images/12.jpg', name: 'Samsung Galaxy Tab A9+ WiFi 128GB Graphite' },
];

const imagesAccessories = [
    { src: '../Images/Product Images/1.jpg', name: 'Casio Classpad Colour CAS Calculator fx-CP400' },
    { src: '../Images/Product Images/2.jpg', name: 'Casio fx-82AU PLUS II 2nd Edition Scientific Calculator ' },
    { src: '../Images/Product Images/13.jpg', name: 'Stationary Pack' },
    { src: '../Images/Product Images/14.jpg', name: 'Books Pack' },
    { src: '../Images/Product Images/15.jpg', name: 'SanDisk 32GB Cruzer Blade USB Flash Drive 3 Pack Bright' },
    { src: '../Images/Product Images/16.jpg', name: 'Sony WHCH520 Wireless Headphones White' },
    { src: '../Images/Product Images/17.jpg', name: 'Bag' },
];

const imagesBanner = [
    { src: '../Images/bannerImages/Banner7.png' },
    { src: '../Images/bannerImages/Banner10.png' }
];

let slideIndexTechnology = 0;
let slideIndexAccessories = 0;
let slideIndexBanner = 0;

function createSlideshow(images, slideshowId) {
    const slideshowContainer = document.getElementById(slideshowId);

    images.forEach((imageInfo, index) => {
        const slide = document.createElement('div');
        slide.classList.add('slide1');

        const imgContainer = document.createElement('div');
        imgContainer.classList.add('image-container');

        const img = document.createElement('img');
        img.src = imageInfo.src;
        img.alt = slideshowId === 'banner' ? 'Banner Image' : imageInfo.name;

        if (slideshowId !== 'banner') {
            const caption = document.createElement('div');
            caption.classList.add('caption');
            caption.textContent = imageInfo.name;
            slide.appendChild(caption);
        }

        const link = document.createElement('a');
        if (slideshowId === 'slideshow1') {
            link.href = 'technology.php';
        } else if (slideshowId === 'slideshow2') {
            link.href = 'accessories.php';
        } else if (slideshowId === 'banner') {
            link.href = '#'; 
            img.addEventListener('click', () => {
                if (imageInfo.src.includes('Banner7')) {
  
                    window.location.href = 'accessories.php?productType=Calculator&price%5B%5D=250%2B&sort=none';
                } else if (imageInfo.src.includes('Banner10')) {
                 
                    window.location.href = 'technology.php?brand=Apple&productType=Handheld+Devices&sort=lowToHigh';
                }
            });
        }
        
        link.appendChild(img);
        imgContainer.appendChild(link);
        slide.appendChild(imgContainer);

      

        slideshowContainer.appendChild(slide);
    });

    if (slideshowId !== 'banner') {
        showSlides(slideshowContainer.children, 0);
    } else {
        showSlides(slideshowContainer.children, slideIndexBanner, slideshowId);
    }
}

function showSlides(slides, slideIndex, slideshowId) {
    slides[slideIndex].style.display = 'block';

    setTimeout(() => {
        slides[slideIndex].style.display = 'none';
        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }
        showSlides(slides, slideIndex);
    }, 2500);
}

window.onload = function() {
    createSlideshow(imagesTechnology, 'slideshow1');
    createSlideshow(imagesAccessories, 'slideshow2');
    createSlideshow(imagesBanner, 'banner');
};

const style = document.createElement('style');
style.textContent = `
    .slide1 {
        display: none;
        position: relative;
        text-align: center;
    }

    .caption {
        background-color: rgba(0, 0, 10, 0.6);
        color: white;
        padding: 1rem; 
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
    }

    #banner .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
`;
document.head.appendChild(style);
