const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');


    burger.addEventListener('click',()=>{
        
    //Burger animation
    burger.classList.toggle('toggle');
        
    // Toggle nav
    nav.classList.toggle('nav-active');

    //Animate Links
    navLinks.forEach((link, index) => {
        if(link.style.animation)
        {
            link.style.animation = '';
        }
        else
        {
            link.style.animation = `navLinkFadeIn 0.4s ease-out forwards ${index / 7 + 0.2}s`;
        }
    });
});


}

navSlide();